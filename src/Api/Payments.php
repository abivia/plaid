<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\Entities\BacsAccount;
use Abivia\Plaid\Entities\PaymentSchedule;
use Abivia\Plaid\Entities\RecipientAddress;
use Abivia\Plaid\PlaidRequestException;
use function is_string;

class Payments extends AbstractResource
{
    /**
     * Create a payment request.
     *
     * @param string $recipientId
     * @param string $reference
     * @param string $amount
     * @param string $currency
     * @param PaymentSchedule|null $paymentSchedule
     * @return Payments
     * @throws PlaidRequestException
     */
    public function create(
        string $recipientId,
        string $reference,
        string $amount,
        string $currency,
        PaymentSchedule $paymentSchedule = null
    ): self {
        $params = [
            "recipient_id" => $recipientId,
            "reference" => $reference,
            "amount" => [
                "value" => $amount,
                "currency" => $currency
            ]
        ];

        if ($paymentSchedule) {
            $params["schedule"] = [
                "interval" => $paymentSchedule->getInterval(),
                "interval_execution_day" => $paymentSchedule->getIntervalExecutionDay(),
                "start_date" => $paymentSchedule->getStartDate()->format("Y-m-d")
            ];
        }

        $this->sendRequest('payment_initiation/payment/create', $params);

        return $this;
    }

    /**
     * Create a recipient request for payment initiation.
     *
     * @param string $name
     * @param string|BacsAccount $account
     * @param RecipientAddress $address
     * @return Payments
     * @throws PlaidRequestException
     */
    public function createRecipient(
        string $name,
        BacsAccount|string $account,
        RecipientAddress $address
    ): self
    {
        $params = [
            'name' => $name,
            'address' => (object)$address->toArray()
        ];

        if (is_string($account)) {
            $params['iban'] = $account;
        } else {
            $params['bacs'] = $account->toArray();
        }

        $this->sendRequest('payment_initiation/recipient/create', $params);

        return $this;
    }

    /**
     * Create a payment token.
     *
     * @param string $payment_id
     * @return Payments
     * @throws PlaidRequestException
     */
    public function createToken(string $payment_id): self
    {
        $this->sendRequest(
            'payment_initiation/payment/token/create',
            ['payment_id' => $payment_id]
        );

        return $this;
    }

    /**
     * Get payment details.
     *
     * @param string $paymentId
     * @return Payments
     * @throws PlaidRequestException
     */
    public function get(string $paymentId): self
    {
        $this->sendRequest(
            "payment_initiation/payment/get",
            ['payment_id' => $paymentId]
        );

        return $this;
    }

    /**
     * Get a recipient request from a payment initiation.
     *
     * @param string $recipientId
     * @return Payments
     * @throws PlaidRequestException
     */
    public function getRecipient(string $recipientId): self
    {
        $this->sendRequest(
            'payment_initiation/recipient/get',
            ['recipient_id' => $recipientId]
        );

        return $this;
    }

    /**
     * List all payments.
     *
     * @param array $options
     * @return Payments
     * @throws PlaidRequestException
     */
    public function list(array $options = []): self
    {
        $this->sendRequest(
            'payment_initiation/payment/list',
            ['options' => (object)$options]
        );

        return $this;
    }

    /**
     * List out all recipients for payment initiations.
     *
     * @return Payments
     * @throws PlaidRequestException
     */
    public function listRecipients(): self
    {
        $this->sendRequest('payment_initiation/recipient/list');

        return $this;
    }
}
