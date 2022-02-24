<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\PlaidRequestException;

class Sandbox extends AbstractResource
{
    /**
     * Create a new public token.
     *
     * @param string $institutionId
     * @param array $initialProducts
     * @param array $options
     * @return Sandbox
     * @throws PlaidRequestException
     */
    public function createPublicToken(
        string $institutionId,
        array $initialProducts,
        array $options = []
    ): self
    {
        $this->sendRequest('sandbox/public_token/create',
            [
                'institution_id' => $institutionId,
                'initial_products' => $initialProducts,
                'options' => (object)$options
            ]
        );

        return $this;
    }

    /**
     * Reset an Item's login status.
     *
     * @param string $accessToken
     * @return Sandbox
     * @throws PlaidRequestException
     */
    public function resetLogin(string $accessToken): self
    {
        $this->sendRequest(
            'sandbox/item/reset_login',
            ['access_token' => $accessToken]
        );

        return $this;
    }

    /**
     * Reset an Item's verification status.
     *
     * @param string $accessToken
     * @param string $accountId
     * @param string $verificationStatus
     * @return Sandbox
     * @throws PlaidRequestException
     */
    public function setVerificationStatus(
        string $accessToken,
        string $accountId,
        string $verificationStatus
    ): self
    {
        $this->sendRequest('sandbox/item/reset_verification_status', [
            'access_token' => $accessToken,
            'account_id' => $accountId,
            'verification_status' => $verificationStatus
        ]);

        return $this;
    }

    /**
     * Fire off a webhook event for an Item.
     *
     * @param string $accessToken
     * @param string $webhookCode
     * @return Sandbox
     * @throws PlaidRequestException
     */
    public function fireWebhook(
        string $accessToken,
        string $webhookCode = "DEFAULT_UPDATE"
    ): self
    {
        $this->sendRequest("sandbox/item/fire_webhook", [
            'access_token' => $accessToken,
            'webhook_code' => $webhookCode
        ]);

        return $this;
    }

    /**
     * Simulate a Bank Transfer.
     *
     * @param string $bankTransferId
     * @param string $eventType
     * @param string|null $achReturnCode
     * @param string|null $failureDescription
     * @return Sandbox
     * @throws PlaidRequestException
     */
    public function simulateBankTransfer(
        string $bankTransferId,
        string $eventType,
        ?string $achReturnCode = null,
        ?string $failureDescription = null
    ): self
    {
        $params = [
            'bank_transfer_id' => $bankTransferId,
            'event_type' => $eventType
        ];

        if ($achReturnCode || $failureDescription) {
            $params['failure_reason'] = [
                'ach_return_code' => $achReturnCode,
                'description' => $failureDescription
            ];
        }

        $this->sendRequest('sandbox/bank_transfer/simulate', $params);

        return $this;
    }

}
