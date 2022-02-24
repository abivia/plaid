<?php

namespace Abivia\Plaid\Api;

use Illuminate\Support\Carbon;
use Abivia\Plaid\PlaidRequestException;

class Investments extends AbstractResource
{
    /**
     * Get investment holdings.
     *
     * @param string $accessToken
     * @param array<string,mixed> $options
     * @return Investments
     * @throws PlaidRequestException
     */
    public function listHoldings(string $accessToken, array $options = []): self
    {
        $this->sendRequest(
            'investments/holdings/get',
            [
                'access_token' => $accessToken,
                'options' => (object)$options
            ]
        );

        return $this;
    }

    /**
     * Get investment transactions.
     *
     * @param string $accessToken
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param array<string,mixed> $options
     * @return Investments
     * @throws PlaidRequestException
     */
    public function listTransactions(
        string $accessToken,
        Carbon $startDate,
        Carbon $endDate,
        array $options = []
    ): self
    {
        $this->sendRequest(
            'investments/transactions/get',
            [
                'access_token' => $accessToken,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'options' => (object)$options
            ]
        );

        return $this;
    }

}
