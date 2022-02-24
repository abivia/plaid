<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\PlaidRequestException;

class Liabilities extends AbstractResource
{
    /**
     * Get Liabilities request.
     *
     * @param string $accessToken
     * @param array<string,mixed> $options
     * @return Liabilities
     * @throws PlaidRequestException
     */
	public function list(string $accessToken, array $options = []): self
	{
        $this->sendRequest(
            'liabilities/get',
            [
                'access_token' => $accessToken,
                'options' => (object) $options
            ]
        );

        return $this;
    }

}
