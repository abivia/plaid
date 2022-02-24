<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\PlaidRequestException;

class Items extends AbstractResource
{
    /**
     * Create a new Item public token.
     *
     * @param string $accessToken
     * @return Items
     * @throws PlaidRequestException
     */
    public function createPublicToken(string $accessToken): self
    {
        $this->sendRequest(
            'item/public_token/create',
            ['access_token' => $accessToken]
        );

        return $this;
    }

    /**
     * Exchange an Item public token for an access token.
     *
     * @param string $publicToken
     * @return Items
     * @throws PlaidRequestException
     */
    public function exchangeToken(string $publicToken): self
    {
        $this->sendRequest(
            'item/public_token/exchange',
            ['public_token' => $publicToken]
        );

        return $this;
    }

    /**
     * Get an Item.
     *
     * @param string $accessToken
     * @return Items
     * @throws PlaidRequestException
     */
    public function get(string $accessToken): self
    {
        $this->sendRequest('item/get', ['access_token' => $accessToken]);

        return $this;
    }

    /**
     * Get an Item's income information.
     *
     * @param string $accessToken
     * @return Items
     * @throws PlaidRequestException
     */
    public function getIncome(string $accessToken): self
    {
        $this->sendRequest('income/get', ['access_token' => $accessToken]);

        return $this;
    }

    /**
     * Remove an Item.
     *
     * @param string $accessToken
     * @return Items
     * @throws PlaidRequestException
     */
    public function remove(string $accessToken): self
    {
        $this->sendRequest('item/remove', ['access_token' => $accessToken]);

        return $this;
    }

    /**
     * Rotate an Item's access token.
     *
     * @param string $accessToken
     * @return Items
     * @throws PlaidRequestException
     */
    public function rotateAccessToken(string $accessToken): self
    {
        $this->sendRequest(
            'item/access_token/invalidate',
            ['access_token' => $accessToken]
        );

        return $this;
    }
}
