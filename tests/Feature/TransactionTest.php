<?php

namespace Abivia\Plaid\Tests\Feature;

use Abivia\Plaid\Facades\Plaid;
use Abivia\Plaid\PlaidRequestException;
use Abivia\Plaid\Tests\TestCase;
use Illuminate\Support\Carbon;

class TransactionTest extends TestCase
{
    const TD_CANADA = 'ins_42';

    public function testGetTransactions()
    {
        try {
            Plaid::environment('sandbox');
            $token = Plaid::sandbox()->createPublicToken(
                self::TD_CANADA, ['transactions']
            )->publicToken;
            $access = Plaid::items()->exchangeToken($token);
            $transactions = Plaid::transactions()->list(
                $access->accessToken, Carbon::yesterday(), Carbon::today()
            );
            $this->assertIsArray($transactions->accounts);
        } catch (PlaidRequestException $ex) {
            $this->addWarning("Plaid error response " . $ex->getMessage());
            print_r($ex->getBody());
        }
    }
}
