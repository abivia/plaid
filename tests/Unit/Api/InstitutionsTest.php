<?php

namespace Abivia\Plaid\Tests\Unit\Api;

use Abivia\Plaid\Api\Institutions;
use Abivia\Plaid\Plaid as PlaidCore;
use Abivia\Plaid\Tests\TestCase;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * @covers \Abivia\Plaid\Plaid
 * @covers \Abivia\Plaid\Api\AbstractResource
 * @covers \Abivia\Plaid\Api\Institutions
 */
class InstitutionsTest extends TestCase
{
    public function testFindInstitution(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('institutions/search',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'query' => 'boeing',
                    'products' =>
                        [
                            0 => 'transactions',
                            1 => 'mfa',
                        ],
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'options' =>
                        (object)[],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Institutions('id', 'secret', '');
        $obj->find('boeing', ['US'], ['transactions', 'mfa']);
    }

    public function testGetInstitution(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('institutions/get_by_id',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'institution_id' => 'ins_12345',
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'options' =>
                        (object)[],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Institutions('id', 'secret', '');
        $obj->get('ins_12345', ['US']);
    }

    public function testListInstitutions(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('institutions/get',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'count' => 100,
                    'offset' => 200,
                    'country_codes' =>
                        [
                            0 => 'US',
                        ],
                    'options' =>
                        (object)[
                        ],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Institutions('id', 'secret', '');
        $obj->list(100, 200, ['US']);
    }
}
