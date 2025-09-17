# JTL Connector Fix for Shopware 6.7

This Shopware 6 plugin fixes JTL incompatibility issues with Shopware 6.7.

## Requirements

- Shopware 6.7.0 or higher
- PHP 8.1 or higher

## Installation

### Via Composer (Recommended)

1. Install the plugin using Composer:
   ```bash
   composer require gigabit/sw6-jtl-connector-fix
   ```

2. Install and activate the plugin:
   ```bash
   bin/console plugin:refresh
   bin/console plugin:install --activate JtlConnectorFix
   ```

### Manual Installation

1. Download the plugin and extract it to `custom/plugins/JtlConnectorFix/`
2. Install and activate the plugin:
   ```bash
   bin/console plugin:refresh
   bin/console plugin:install --activate JtlConnectorFix
   ```

## Features

- Ensures compatibility between JTL Connector and Shopware 6.7
- Minimal footprint with no breaking changes to existing functionality

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
