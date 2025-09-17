<?php

namespace GigabitIo\JtlConnectorFix\Api;

use Shopware\Core\Framework\Api\Controller\ApiController as CoreApiController;
use Shopware\Core\Framework\Api\Response\ResponseFactoryInterface;
use Shopware\Core\Framework\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ApiControllerOverride extends CoreApiController
{
    public function detail(
        Request $request,
        Context $context,
        ResponseFactoryInterface $responseFactory,
        string $entityName,
        string $path
    ): Response {
        $allQuery = $request->query->all();
        if (
            array_key_exists('associations', $allQuery) &&
            false === array_key_exists('tax', $allQuery['associations']) &&
            $request->attributes->get('_route') === 'api.product.detail'
        ) {
            // we add tax association if it's a product detail request, because JTL Connector is missing it
            $allQuery['associations']['tax'][] = "1";
            $request->query->set('associations', $allQuery['associations']);
        }

        return parent::detail($request, $context, $responseFactory, $entityName, $path);
    }
}