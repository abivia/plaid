<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\Entities\User;
use Abivia\Plaid\PlaidRequestException;
use Abivia\Plaid\Entities\AccountFilters;

class Tokens extends AbstractResource
{
    /**
     * Create a Link Token.
     *
     * @param string $clientName
     * @param string $language Possible values are: en, fr, es, nl
     * @param array<string> $countryCodes Possible values are: CA, FR, IE, NL, ES, GB, US
     * @param User $user
     * @param array<string> $products Possible values are: transactions, auth, identity, income, assets, investments, liabilities, payment_initiation
     * @param string|null $webhook
     * @param string|null $linkCustomizationName
     * @param AccountFilters|null $accountFilters
     * @param string|null $accessToken
     * @param string|null $redirectUri
     * @param string|null $androidPackageName
     * @param string|null $paymentId
     * @param string|null $institutionId
     * @return Tokens
     * @throws PlaidRequestException
     */
    public function create(
        string $clientName,
        string $language,
        array $countryCodes,
        User $user,
        array $products = [],
        ?string $webhook = null,
        ?string $linkCustomizationName = null,
        ?AccountFilters $accountFilters = null,
        ?string $accessToken = null,
        ?string $redirectUri = null,
        ?string $androidPackageName = null,
        ?string $paymentId = null,
        ?string $institutionId = null): self
    {

        $params = [
            'client_name' => $clientName,
            'language' => $language,
            'country_codes' => $countryCodes,
            'user' => $user->toArray(),
            'products' => $products
        ];
        if ($webhook) {
            $params['webhook'] = $webhook;
        }
        if ($linkCustomizationName) {
            $params['link_customization_name'] = $linkCustomizationName;
        }
        if ($accountFilters) {
            $params['account_filters'] = $accountFilters->toArray();
        }
        if ($accessToken) {
            $params['access_token'] = $accessToken;
        }
        if ($redirectUri) {
            $params['redirect_uri'] = $redirectUri;
        }
        if ($androidPackageName) {
            $params['android_package_name'] = $androidPackageName;
        }
        if ($paymentId) {
            $params['payment_initiation'] = [
                'payment_id' => $paymentId
            ];
        }
        if ($institutionId) {
            $params['institution_id'] = $institutionId;
        }

        $this->sendRequest('link/token/create', $params);

        return $this;
    }

    /**
     * Get information about a previously created Link token.
     *
     * @param string $linkToken
     * @return Tokens
     * @throws PlaidRequestException
     */
    public function get(string $linkToken): self
    {
        $this->sendRequest('link/token/get', ['link_token' => $linkToken]);

        return $this;
    }

}
