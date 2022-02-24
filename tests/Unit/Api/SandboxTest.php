<?php

namespace Abivia\Plaid\Tests\Unit\Api;

use Abivia\Plaid\Api\Sandbox;
use Abivia\Plaid\Plaid as PlaidCore;
use Abivia\Plaid\Tests\TestCase;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


/**
 * @covers \Abivia\Plaid\Plaid
 * @covers \Abivia\Plaid\Api\AbstractResource
 * @covers \Abivia\Plaid\Api\Sandbox
 */
class SandboxTest extends TestCase
{
    public function testCreatePublicToken(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('sandbox/public_token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'institution_id' => 'institution_id',
                    'initial_products' =>
                        [
                            0 => 'product1',
                            1 => 'product2',
                        ],
                    'options' =>
                        (object)[
                        ],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Sandbox('id', 'secret', '');
        $obj->createPublicToken(
            'institution_id',
            ['product1', 'product2']
        );
    }

    public function testFireWebhook(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('sandbox/item/fire_webhook',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'access_token' => 'access_token',
                    'webhook_code' => 'DEFAULT_UPDATE',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Sandbox('id', 'secret', '');
        $obj->fireWebhook('access_token');
    }

    public function testResetLogin(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('sandbox/item/reset_login',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'access_token' => 'access_token',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Sandbox('id', 'secret', '');
        $obj->resetLogin('access_token');
    }

    public function testSetVerificationStatus(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('sandbox/item/reset_verification_status',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'access_token' => 'access_token',
                    'account_id' => 'account_id',
                    'verification_status' => 'verification_status',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Sandbox('id', 'secret', '');
        $obj->setVerificationStatus(
            'access_token',
            'account_id',
            'verification_status'
        );
    }

    public function testSimulateBankTransfer(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('sandbox/bank_transfer/simulate',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'bank_transfer_id' => 'bank_transfer_id',
                    'event_type' => 'event_type',
                    'failure_reason' =>
                        [
                            'ach_return_code' => 'ach_return_code',
                            'description' => 'failure_description',
                        ],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Sandbox('id', 'secret', '');
        $obj->simulateBankTransfer(
            'bank_transfer_id',
            'event_type',
            'ach_return_code',
            'failure_description'
        );
    }
}
