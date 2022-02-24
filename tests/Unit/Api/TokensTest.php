<?php

namespace Abivia\Plaid\Tests\Unit\Api;

use Abivia\Plaid\Api\Tokens;
use Abivia\Plaid\Entities\AccountFilters;
use Abivia\Plaid\Entities\User;
use Abivia\Plaid\Plaid as PlaidCore;
use Abivia\Plaid\Tests\TestCase;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * @covers \Abivia\Plaid\Plaid
 * @covers \Abivia\Plaid\Api\AbstractResource
 * @covers \Abivia\Plaid\Api\tokens
 * @covers \Abivia\Plaid\Entities\AccountFilters
 * @covers \Abivia\Plaid\Entities\User
 */
class TokensTest extends TestCase
{
    public function testAccessToken(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'client_name' => 'client_name',
                    'language' => 'en',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'user' =>
                        [
                            'client_user_id' => 'usr_12345',
                        ],
                    'products' =>
                        [
                        ],
                    'access_token' => 'access_token',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->create(
            'client_name',
            'en',
            ['US'],
            new User('usr_12345'),
            [],
            null,
            null,
            null,
            'access_token'
        );
    }

    public function testAccountFilters(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'client_name' => 'client_name',
                    'language' => 'en',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'user' =>
                        [
                            'client_user_id' => 'usr_12345',
                        ],
                    'products' =>
                        [
                        ],
                    'account_filters' =>
                        [
                            'depository' =>
                                [
                                    'account_subtypes' =>
                                        [
                                            0 => 'auth',
                                            1 => 'transactions',
                                        ],
                                ],
                        ],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->create(
            'client_name',
            'en',
            ['US'],
            new User('usr_12345'),
            [],
            null,
            null,
            (new AccountFilters)->setDepositoryFilters(['auth', 'transactions'])
        );
    }

    public function testAndroidPackageName(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'client_name' => 'client_name',
                    'language' => 'en',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'user' =>
                        [
                            'client_user_id' => 'usr_12345',
                        ],
                    'products' =>
                        [
                        ],
                    'android_package_name' => 'android_package_name',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->create(
            'client_name',
            'en',
            ['US'],
            new User('usr_12345'),
            [],
            null,
            null,
            null,
            null,
            null,
            'android_package_name'
        );
    }

    public function testInstitutionId(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'client_name' => 'client_name',
                    'language' => 'en',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'user' =>
                        [
                            'client_user_id' => 'usr_12345',
                        ],
                    'products' =>
                        [
                        ],
                    'institution_id' => 'institution_id',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->create(
            'client_name',
            'en',
            ['US'],
            new User('usr_12345'),
            [],
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            'institution_id'
        );
    }

    public function testLinkCustomizationName(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'client_name' => 'client_name',
                    'language' => 'en',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'user' =>
                        [
                            'client_user_id' => 'usr_12345',
                        ],
                    'products' =>
                        [
                        ],
                    'link_customization_name' => 'link customization name',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->create(
            'client_name',
            'en',
            ['US'],
            new User('usr_12345'),
            [],
            null,
            'link customization name'
        );
    }

    public function testPaymentId(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'client_name' => 'client_name',
                    'language' => 'en',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'user' =>
                        [
                            'client_user_id' => 'usr_12345',
                        ],
                    'products' =>
                        [
                        ],
                    'payment_initiation' =>
                        [
                            'payment_id' => 'pmt_12345',
                        ],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->create(
            'client_name',
            'en',
            ['US'],
            new User('usr_12345'),
            [],
            null,
            null,
            null,
            null,
            null,
            null,
            'pmt_12345'
        );
    }

    public function testRedirectUri(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'client_name' => 'client_name',
                    'language' => 'en',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'user' =>
                        [
                            'client_user_id' => 'usr_12345',
                        ],
                    'products' =>
                        [
                        ],
                    'redirect_uri' => 'http://redirect.uri',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->create(
            'client_name',
            'en',
            ['US'],
            new User('usr_12345'),
            [],
            null,
            null,
            null,
            null,
            'http://redirect.uri'
        );
    }

    public function testRequiredParameters(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'client_name' => 'client_name',
                    'language' => 'en',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'user' =>
                        [
                            'client_user_id' => 'usr_12345',
                        ],
                    'products' =>
                        [
                            0 => 'transactions',
                            1 => 'auth',
                        ],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->create(
            'client_name',
            'en',
            ['US'],
            new User('usr_12345'),
            ['transactions', 'auth']
        );
    }

    public function testWebhook(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'client_name' => 'client_name',
                    'language' => 'en',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'user' =>
                        [
                            'client_user_id' => 'usr_12345',
                        ],
                    'products' =>
                        [
                        ],
                    'webhook' => 'http://webhook.url',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->create(
            'client_name',
            'en',
            ['US'],
            new User('usr_12345'),
            [],
            'http://webhook.url'
        );
    }

    public function test_get_token(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('link/token/get',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'link_token' => 'link_token',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Tokens('id', 'secret', '');
        $obj->get('link_token');
    }
}
