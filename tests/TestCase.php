<?php

namespace Abivia\Plaid\Tests;

use Abivia\Plaid\Plaid;
use Abivia\Plaid\PlaidServiceProvider;
use Dotenv\Dotenv;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $loadEnvironmentVariables = true;

    protected function expectPlaidHeader()
    {
        Http::shouldReceive('withHeaders')
            ->once()
            ->with(['Plaid-Version' => Plaid::API_VERSION,])
            ->andReturnSelf();
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
        $dotenv = Dotenv::createImmutable(__DIR__, '../.env.testing');
        $dotenv->safeLoad();
    }

    protected function getPackageProviders($app)
    {
        return [
            PlaidServiceProvider::class,
        ];
    }

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }
}
