<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\PlaidRequestException;

class Auth extends AbstractResource
{
    /**
     * Get Auth request.
     *
     * @param string $accessToken
     * @param array<string,mixed> $options
     * @return Auth
     * @throws PlaidRequestException
     */
	public function get(string $accessToken, array $options = []): self
	{
        $this->sendRequest(
            'auth/get',
            [
                'access_token' => $accessToken,
                'options' => (object) $options
            ]
        );

        return $this;
	}
}
