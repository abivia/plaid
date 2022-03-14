<?php

namespace Abivia\Plaid\Tests\Unit\Api;

use Abivia\Plaid\Api\Auth;
use Abivia\Plaid\Plaid as PlaidCore;
use Abivia\Plaid\Tests\TestCase;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


/**
 * @covers \Abivia\Plaid\Plaid
 * @covers \Abivia\Plaid\Api\AbstractResource
 * @covers \Abivia\Plaid\Api\Auth
 */
class AuthTest extends TestCase
{
    public function testGetAuth(): void
    {
        $psrResponse = new PsrResponse(200, [], '{}');
        Http::shouldReceive('post')
            ->with('auth/get',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'access_token' => 'access_token',
                    'options' => (object)[],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Auth('id', 'secret', '');
        $obj->get('access_token');
    }
}
