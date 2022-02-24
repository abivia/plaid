<?php

namespace Abivia\Plaid;

use Abivia\Plaid\Api\Accounts;
use Abivia\Plaid\Api\Auth;
use Abivia\Plaid\Api\BankTransfers;
use Abivia\Plaid\Api\Categories;
use Abivia\Plaid\Api\Institutions;
use Abivia\Plaid\Api\Investments;
use Abivia\Plaid\Api\Items;
use Abivia\Plaid\Api\Liabilities;
use Abivia\Plaid\Api\Payments;
use Abivia\Plaid\Api\Processors;
use Abivia\Plaid\Api\Reports;
use Abivia\Plaid\Api\Sandbox;
use Abivia\Plaid\Api\Tokens;
use Abivia\Plaid\Api\Transactions;
use Abivia\Plaid\Api\Webhooks;
use Abivia\Plaid\Api\AbstractResource;
use UnexpectedValueException;
use function class_exists;


/**
 */
class Plaid
{
    const API_VERSION = '2020-09-14';

    /**
     * @var string Environment-specific target URL.
     */
    protected string $baseUrl;
    /**
     * @var string Plaid client Id.
     */
    protected string $clientId;

    /**
     * @var string Plaid client secret.
     */
    protected string $clientSecret;

    protected string $envString;

    /**
     * @var array<string,string> Plaid API environments and matching hostname.
     */
    protected static array $plaidEnvironments = [
        'production' => 'https://production.plaid.com/',
        'development' => 'https://development.plaid.com/',
        'sandbox' => 'https://sandbox.plaid.com/',
    ];

    /**
     * @param ?string $clientId
     * @param ?string $clientSecret
     * @param ?string $environment Possible values: production, development, sandbox
     * @throws UnexpectedValueException
     */
    public function __construct(
        ?string $clientId = null,
        ?string $clientSecret = null,
        ?string $environment = null)
    {
        $this->environment($environment);
        $this->client($clientId);
        $this->secret($clientSecret);
    }

    /**
     * Magic api factory.
     *
     * @param string $resourceName
     * @param array $args
     * @return AbstractResource
     * @throws UnexpectedValueException
     */
    public function __call(string $resourceName, array $args): AbstractResource
    {
        $resourceClass = __NAMESPACE__ . "\\Api\\$resourceName";
        if (!class_exists($resourceClass)) {
            throw new UnexpectedValueException("Unknown Plaid resource: {$resourceName}");
        }
        return new $resourceClass($this->clientId, $this->clientSecret, $this->baseUrl);
    }

    public function baseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    public function client(?string $clientId): self
    {
        $this->clientId = $clientId ?? env('PLAID_CLIENT_ID');

        return $this;
    }

    public function environment(?string $environment = null): self
    {
        $environment ??= env('PLAID_ENVIRONMENT', 'production');
        if (isset(self::$plaidEnvironments[$environment])) {
            $this->envString = $environment;
            $this->baseUrl = self::$plaidEnvironments[$environment];
        } else {
            throw new UnexpectedValueException(
                'Invalid environment. Environment must be one of: '
                . implode(',', array_keys(self::$plaidEnvironments)) . '.'
            );
        }

        return $this;
    }

    public function secret(?string $clientSecret = null): self
    {
        if ($clientSecret === null) {
            if (!isset($this->envString)) {
                $this->environment();
            }
            $envVar = 'PLAID_' . strtoupper($this->envString) . '_SECRET';
            $this->clientSecret = env($envVar);
        } else {
            $this->clientSecret = $clientSecret;
        }

        return $this;
    }

}
