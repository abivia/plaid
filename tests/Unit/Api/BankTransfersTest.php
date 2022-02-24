<?php

namespace Abivia\Plaid\Tests\Unit\Api;

use Abivia\Plaid\Api\BankTransfers;
use Abivia\Plaid\Entities\AccountHolder;
use Abivia\Plaid\Plaid as PlaidCore;
use Abivia\Plaid\Tests\TestCase;
use Illuminate\Support\Carbon;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * @covers \Abivia\Plaid\Plaid
 * @covers \Abivia\Plaid\Api\AbstractResource
 * @covers \Abivia\Plaid\Api\BankTransfers
 * @covers \Abivia\Plaid\Entities\AccountHolder
 */
class BankTransfersTest extends TestCase
{
    public function testCancelBankTransfer(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('bank_transfer/cancel',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'bank_transfer_id' => 'bank_transfer_id',
                ])
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new BankTransfers('id', 'secret', '');
        $obj->cancel('bank_transfer_id');
    }

    public function testCreateBankTransfer(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('bank_transfer/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'access_token' => 'access_token',
                    'idempotency_key' => 'idempotency_key',
                    'type' => 'type',
                    'account_id' => 'account_id',
                    'network' => 'network',
                    'amount' => '10.00',
                    'iso_currency_code' => 'USD',
                    'description' => 'descript',
                    'user' =>
                        [
                            'legal_name' => 'Test Name',
                            'email' => 'test@example.com',
                        ],
                    'metadata' =>
                        (object)[
                            'meta1' => 'value1',
                        ],
                    'ach_class' => 'ach_class',
                    'custom_tag' => 'custom_tag',
                    'origination_account_id' => 'origination_account_id',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new BankTransfers('id', 'secret', '');
        $obj->create(
            'access_token',
            'idempotency_key',
            'type',
            'account_id',
            'network',
            '10.00',
            'USD',
            new AccountHolder('Test Name', 'test@example.com'),
            'description',
            'ach_class',
            'custom_tag',
            ['meta1' => 'value1'],
            'origination_account_id'
        );
    }

    public function testGetAccountBalance(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('bank_transfer/balance/get',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'origination_account_id' => 'origination_account_id',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new BankTransfers('id', 'secret', '');
        $obj->getOriginationAccountBalance('origination_account_id');
    }

    public function testGetEventList(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('bank_transfer/event/list',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'start_date' => '2019-01-01T00:00:00+00:00',
                    'end_date' => '2019-01-31T00:00:00+00:00',
                    'bank_transfer_id' => 'bank_transfer_id',
                    'account_id' => 'account_id',
                    'bank_transfer_type' => 'bank_transfer_type',
                    'event_type' =>
                        [
                            0 => 'type1',
                        ],
                    'count' => 100,
                    'offset' => 500,
                    'direction' => 'asc',
                    'origination_account_id' => 'origination_account_id',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new BankTransfers('id', 'secret', '');
        $obj->listEvents(
            new Carbon('2019-01-01'),
            new Carbon('2019-01-31'),
            'bank_transfer_id',
            'account_id',
            'bank_transfer_type',
            ['type1'],
            100,
            500,
            'asc',
            'origination_account_id'
        );
    }

    public function testListBankTransfers(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('bank_transfer/list',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'start_date' => '2019-01-01T00:00:00+00:00',
                    'end_date' => '2019-01-31T00:00:00+00:00',
                    'count' => 100,
                    'offset' => 500,
                    'direction' => 'asc',
                    'origination_account_id' => 'origination_account_id',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new BankTransfers('id', 'secret', '');
        $obj->list(
            new Carbon('2019-01-01'),
            new Carbon('2019-01-31'),
            100,
            500,
            'asc',
            'origination_account_id'
        );
    }

    public function testMigrateAccount(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('bank_transfer/migrate_account',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'account_number' => 'account_number',
                    'routing_number' => 'routing_number',
                    'account_type' => 'account_type',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new BankTransfers('id', 'secret', '');
        $obj->migrateAccount(
            'account_number',
            'routing_number',
            'account_type'
        );
    }

    public function testSyncEvents(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('bank_transfer/event/sync',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'after_id' => 'after_id',
                    'count' => 100,
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new BankTransfers('id', 'secret', '');
        $obj->syncEvents('after_id', 100);
    }

    public function test_get_bank_transfer(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('bank_transfer/get',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'bank_transfer_id' => 'bank_transfer_id',
                ])
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new BankTransfers('id', 'secret', '');
        $obj->get('bank_transfer_id');
    }
}
