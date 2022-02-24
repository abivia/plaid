<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\PlaidRequestException;

class Processors extends AbstractResource
{
    /**
     * Create a processor token.
     *
     * @param string $accessToken
     * @param string $accountId
     * @param string $processor
     * @return Processors
     * @throws PlaidRequestException
     */
	public function createToken(string $accessToken, string $accountId, string $processor): self
	{
        $this->sendRequest(
            'processor/token/create',
            [
                'access_token' => $accessToken,
                'account_id' => $accountId,
                'processor' => $processor
            ]
        );

        return $this;
    }

    /**
     * Get processor auth data.
     *
     * @param string $processorToken
     * @return Processors
     * @throws PlaidRequestException
     */
	public function getAuth(string $processorToken): self
	{
		$this->sendRequest(
			'processor/auth/get',
            ['processor_token' => $processorToken]
		);

        return $this;
    }

    /**
     * Get the balance of accounts from processor.
     *
     * @param string $processorToken
     * @return Processors
     * @throws PlaidRequestException
     */
	public function getBalance(string $processorToken): self
	{
		$this->sendRequest(
			'processor/balance/get',
            ['processor_token' => $processorToken]
        );

        return $this;
    }

    /**
     * Get account holder information from the processor.
     *
     * @param string $processorToken
     * @return Processors
     * @throws PlaidRequestException
     */
	public function getIdentity(string $processorToken): self
	{
		$this->sendRequest(
			'processor/identity/get',
            ['processor_token' => $processorToken]
		);

        return $this;
    }

    /**
     * Create Stripe token.
     *
     * @param string $accessToken
     * @param string $accountId
     * @return Processors
     * @throws PlaidRequestException
     */
	public function createStripeToken(string $accessToken, string $accountId): self
	{
		$this->sendRequest(
            'processor/stripe/bank_account_token/create',
            [
                'access_token' => $accessToken,
                'account_id' => $accountId
            ]
        );

        return $this;
    }

    /**
     * Create Dwolla token.
     *
     * @param string $accessToken
     * @param string $accountId
     * @return Processors
     * @throws PlaidRequestException
     */
	public function createDwollaToken(string $accessToken, string $accountId): self
	{
		$this->sendRequest(
            'processor/dwolla/processor_token/create',
            [
                'access_token' => $accessToken,
                'account_id' => $accountId
            ]
        );

        return $this;
    }

}
