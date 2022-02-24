<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\PlaidRequestException;

class Accounts extends AbstractResource
{
    /**
     * Get all Accounts.
     *
     * @param string $accessToken
     * @param array<string,mixed> $options
     * @return Accounts
     * @throws PlaidRequestException
     */
	public function list(string $accessToken, array $options = []): self
	{
        $this->sendRequest(
            'accounts/get',
            [
                'access_token' => $accessToken,
                'options' => (object) $options
            ]
        );

        return $this;
	}

    /**
     * Get Account balance.
     *
     * @param string $accessToken
     * @param array<string,mixed> $options
     * @return Accounts
     * @throws PlaidRequestException
     */
	public function getBalance(string $accessToken, array $options = []): self
	{
        $this->sendRequest(
            'accounts/balance/get',
            [
                'access_token' => $accessToken,
                'options' => (object) $options
            ]
        );

        return $this;
	}

    /**
     * Get Account identity information.
     *
     * @param string $accessToken
     * @param array<string,mixed> $options
     * @return Accounts
     * @throws PlaidRequestException
     */
	public function getIdentity(string $accessToken, array $options = []): self
	{
        $this->sendRequest(
            'identity/get',
            [
                'access_token' => $accessToken,
                'options' => (object) $options
            ]
        );

        return $this;
	}
}
