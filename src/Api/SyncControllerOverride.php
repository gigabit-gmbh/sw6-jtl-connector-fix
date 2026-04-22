<?php

namespace GigabitIo\JtlConnectorFix\Api;


use Shopware\Core\Framework\Api\ApiException;
use Shopware\Core\Framework\Api\Sync\SyncServiceInterface;
use Shopware\Core\Framework\Context;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Shopware\Core\Framework\Api\Controller\SyncController as CoreSyncController;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

final class SyncControllerOverride extends CoreSyncController
{
    public function __construct(
        private readonly SyncServiceInterface $syncService,
        private readonly DecoderInterface $serializer,
    ) {
        parent::__construct(
            $this->syncService,
            $this->serializer,
        );
    }

    public function sync(Request $request, Context $context): JsonResponse
    {
        try {
            $payload = $this->serializer->decode($request->getContent(), 'json');
        } catch (NotEncodableValueException) {
            throw ApiException::invalidApiType('json');
        }

        foreach ($payload as &$payloadPart) {
            if ($payloadPart['entity'] !== 'product') {
                continue;
            }
            foreach ($payloadPart['payload'] as &$product) {
                if (!is_array($product['prices'] ?? null)) {
                    continue;
                }
                foreach ($product['prices'] as &$price) {
                    if (($price['quantityStart'] ?? 1) < 1) {
                        $price['quantityStart'] = 1;
                    }
                }
                unset($price);
            }
            unset($product);
        }
        unset($payloadPart);

        try {
            $newContent = $this->serializer->encode($payload, 'json');
        } catch (UnexpectedValueException) {
            throw ApiException::invalidApiType('json');
        }

        $request->request->replace($payload);
        $request->server->set('CONTENT_LENGTH', (string)strlen($newContent));
        $request->headers->set('content-length', (string)strlen($newContent));

        $request->initialize(
            $request->query->all(),
            $request->request->all(),
            $request->attributes->all(),
            $request->cookies->all(),
            $request->files->all(),
            $request->server->all(),
            $newContent
        );

        return parent::sync($request, $context);
    }
}
