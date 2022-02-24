<?php

namespace Abivia\Plaid\Api;

use Illuminate\Support\Carbon;
use Abivia\Plaid\Entities\AccountHolder;
use Abivia\Plaid\PlaidRequestException;
use function substr;

class BankTransfers extends AbstractResource
{
    /**
     * Cancel a bank transfer.
     *
     * @param string $bankTransferId
     * @return BankTransfers
     * @throws PlaidRequestException
     */
    public function cancel(string $bankTransferId): self
    {
        $this->sendRequest('bank_transfer/cancel',
            ['bank_transfer_id' => $bankTransferId]
        );

        return $this;
    }

    /**
     * Create a new bank transfer.
     *
     * @param string $accessToken
     * @param string $idempotencyKey
     * @param string $type
     * @param string $accountId
     * @param string $network
     * @param string $amount
     * @param string $currencyCode
     * @param AccountHolder $accountHolder
     * @param string $description
     * @param string|null $achClass
     * @param string|null $customTag
     * @param array $metadata
     * @param string|null $originationAccountId
     * @return BankTransfers
     * @throws PlaidRequestException
     */
    public function create(
        string $accessToken,
        string $idempotencyKey,
        string $type,
        string $accountId,
        string $network,
        string $amount,
        string $currencyCode,
        AccountHolder $accountHolder,
        string $description,
        string $achClass = null,
        string $customTag = null,
        array $metadata = [],
        string $originationAccountId = null
    ): self
    {
        $params = [
            'access_token' => $accessToken,
            'idempotency_key' => $idempotencyKey,
            'type' => $type,
            'account_id' => $accountId,
            'network' => $network,
            'amount' => $amount,
            'iso_currency_code' => $currencyCode,
            'description' => substr($description, 0, 8),
            'user' => $accountHolder->toArray(),
            'metadata' => $metadata ? (object)$metadata : null
        ];

        if ($achClass) {
            $params['ach_class'] = $achClass;
        }

        if ($customTag) {
            $params['custom_tag'] = $customTag;
        }

        if ($originationAccountId) {
            $params['origination_account_id'] = $originationAccountId;
        }

        $this->sendRequest('bank_transfer/create', $params);

        return $this;
    }

    /**
     * Get details about a bank transfer.
     *
     * @param string $bankTransferId
     * @return BankTransfers
     * @throws PlaidRequestException
     */
    public function get(string $bankTransferId): self
    {
        $this->sendRequest(
            'bank_transfer/get',
            ['bank_transfer_id' => $bankTransferId]
        );

        return $this;
    }

    /**
     * Get the origination account balance.
     *
     * @param string|null $originationAccountId
     * @return BankTransfers
     * @throws PlaidRequestException
     */
    public function getOriginationAccountBalance(string $originationAccountId = null): self
    {
        $params = [];

        if ($originationAccountId) {
            $params['origination_account_id'] = $originationAccountId;
        }
        $this->sendRequest('bank_transfer/balance/get', $params);

        return $this;
    }

    /**
     * Get list of bank transfers.
     *
     * @param Carbon|null $startDate
     * @param Carbon|null $endDate
     * @param integer|null $count
     * @param integer|null $offset
     * @param string|null $direction
     * @param string|null $originationAccountId
     * @return BankTransfers
     * @throws PlaidRequestException
     */
    public function list(
        ?Carbon $startDate = null,
        ?Carbon $endDate = null,
        ?int $count = null,
        ?int $offset = null,
        ?string $direction = null,
        ?string $originationAccountId = null
    ): self
    {
        $params = [];
        if ($startDate) {
            $params['start_date'] = $startDate->format('c');
        }
        if ($endDate) {
            $params['end_date'] = $endDate->format('c');
        }
        if ($count) {
            $params['count'] = $count;
        }
        if ($offset) {
            $params['offset'] = $offset;
        }
        if ($direction) {
            $params['direction'] = $direction;
        }
        if ($originationAccountId) {
            $params['origination_account_id'] = $originationAccountId;
        }

        $this->sendRequest('bank_transfer/list', $params);

        return $this;
    }

    /**
     * Get list of bank transfer events.
     *
     * @param Carbon|null $startDate
     * @param Carbon|null $endDate
     * @param string|null $bankTransferId
     * @param string|null $accountId
     * @param string|null $bankTransferType
     * @param array<string> $eventType
     * @param integer|null $count
     * @param integer|null $offset
     * @param string|null $direction
     * @param string|null $originationAccountId
     * @return BankTransfers
     * @throws PlaidRequestException
     */
    public function listEvents(
        ?Carbon $startDate = null,
        ?Carbon $endDate = null,
        ?string $bankTransferId = null,
        ?string $accountId = null,
        ?string $bankTransferType = null,
        array $eventType = [],
        ?int $count = null,
        ?int $offset = null,
        ?string $direction = null,
        ?string $originationAccountId = null
    ): self
    {
        $params = [];

        if ($startDate) {
            $params['start_date'] = $startDate->format('c');
        }
        if ($endDate) {
            $params['end_date'] = $endDate->format('c');
        }
        if ($bankTransferId) {
            $params['bank_transfer_id'] = $bankTransferId;
        }
        if ($accountId) {
            $params['account_id'] = $accountId;
        }
        if ($bankTransferType) {
            $params['bank_transfer_type'] = $bankTransferType;
        }
        if ($eventType) {
            $params['event_type'] = $eventType;
        }
        if ($count) {
            $params['count'] = $count;
        }
        if ($offset) {
            $params['offset'] = $offset;
        }
        if ($direction) {
            $params['direction'] = $direction;
        }
        if ($originationAccountId) {
            $params['origination_account_id'] = $originationAccountId;
        }

        $this->sendRequest('bank_transfer/event/list', $params);

        return $this;
    }


    /**
     * Migrate an account.
     *
     * @param string $accountNumber
     * @param string $routingNumber
     * @param string $accountType
     * @return BankTransfers
     * @throws PlaidRequestException
     */
    public function migrateAccount(
        string $accountNumber,
        string $routingNumber,
        string $accountType): self
    {
        $this->sendRequest(
            'bank_transfer/migrate_account',
            [
                'account_number' => $accountNumber,
                'routing_number' => $routingNumber,
                'account_type' => $accountType
            ]
        );

        return $this;
    }


    /**
     * Sync bank transfer events.
     *
     * @param string $afterId
     * @param integer|null $count
     * @return BankTransfers
     * @throws PlaidRequestException
     */
    public function syncEvents(string $afterId, ?int $count = null): self
    {
        $params = [
            'after_id' => $afterId
        ];

        if ($count) {
            $params['count'] = $count;
        }

        $this->sendRequest('bank_transfer/event/sync', $params);

        return $this;
    }
}
