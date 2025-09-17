# JTL Connector Fix for Shopware 6.7

This Shopware 6 plugin fixes JTL Connector incompatibility issues with Shopware 6.7.

## Requirements

- Shopware 6.7.0 or higher

## Installation

### Via Composer (Recommended)

1. Install the plugin using Composer:
   ```bash
   composer require gigabit-gmbh/sw6-jtl-connector-fix
   ```

2. Install and activate the plugin:
   ```bash
   bin/console plugin:refresh
   bin/console plugin:install --activate GigabitIoJtlConnectorFix
   ```

### Manual Installation

1. Download the plugin and extract it to `custom/plugins/GigabitIoJtlConnectorFix/`
2. Install and activate the plugin:
   ```bash
   bin/console plugin:refresh
   bin/console plugin:install --activate GigabitIoJtlConnectorFix
   ```

## Features

- Ensures compatibility between JTL Connector and Shopware 6.7
- Minimal footprint with no breaking changes to existing functionality

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
