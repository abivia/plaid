# Plaid for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abivia/plaid.svg?style=flat-square)](https://packagist.org/packages/abivia/plaid)
[![License](https://img.shields.io/github/license/abivia/plaid.svg?style=flat-square)](https://packagist.org/packages/abivia/plaid)
[![Total Downloads](https://img.shields.io/packagist/dt/abivia/plaid.svg?style=flat-square)](https://packagist.org/packages/abivia/plaid)

A fluent Laravel package for Plaid (https://plaid.com).

Inspired by [tomorrowideas/plaid-sdk-php](https://github.com/TomorrowIdeas/plaid-sdk-php)

Supported features:
* Accounts
* Assets
* Auth
* Balance
* Bank Transfers (US only)
* Identity
* Income
* Institutions
* Investments
* Items
* Liabilities
* Link tokens
* Payment Initiation (UK only)
* Processors (including Stripe & Dwolla)
* Sandbox
* Webhooks

## Official Plaid API docs

For full description of requests/responses, please see the
[official Plaid API docs](https://plaid.com/docs/). Note that **all Plaid responses are converted to
camel case**.

## Requirements

* PHP 8.0+
* Laravel 8+

## Installation

Via composer:

```bash
composer require abivia/plaid
```

## Usage

Set Plaid credentials in your environment. The default environment is "production". You only need to
provide secrets for the environments you are using.
```ini
PLAID_ENVIRONMENT=sandbox
PLAID_CLIENT_ID=your_client_id
PLAID_DEVELOPMENT_SECRET=dev_secret
PLAID_PRODUCTION_SECRET=prod_secret
PLAID_SANDBOX_SECRET=sandbox_secret
```

```php
$token = Plaid::sandbox()->createPublicToken($myId, ['transactions'])->publicToken;
$accessToken = Plaid::items()->exchangeToken($token)->accessToken;
$transactions = Plaid::transactions()->list(
    $accessToken, Carbon::make('2022-01-01'), Carbon::make('2022-01-31')
);
```

## Testing

Note: feature tests require valid credentials and Plaid may return a 400 error with a
PRODUCT_NOT_READY error code. In this event the test will end with a warning status.

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Security issues should be sent by email to [foss@abivia.com](mailto:foss@abivia.com).

## Credits

- [Alan Langford](https://github.com/instancezero)

Based on original work by [TomorrowIdeas](https://github.com/TomorrowIdeas) and 
[Brent Scheffler](https://github.com/brentscheffler)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Donations welcome

If you're getting something out of Plaid, you can sponsor us in any amount you wish using Liberapay
[![Liberapay](https://liberapay.com/assets/widgets/donate.svg)](https://liberapay.com/abivia/donate).
Liberapay is itself run on donations and charges no fees beyond bank charges.
