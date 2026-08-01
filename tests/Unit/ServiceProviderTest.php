<?php

namespace Abivia\Plaid\Tests\Unit;

use Abivia\Plaid\Plaid;
use Abivia\Plaid\PlaidServiceProvider;
use Abivia\Plaid\Tests\TestCase;

/**
 * @covers \Abivia\Plaid\PlaidServiceProvider
 */
class ServiceProviderTest extends TestCase
{
    public function testServiceProviderIsRegistered(): void
    {
        $this->assertArrayHasKey(
            PlaidServiceProvider::class,
            $this->app->getLoadedProviders()
        );
    }

    public function testPlaidSingletonIsResolved(): void
    {
        $plaid = $this->app->make('plaid');

        $this->assertInstanceOf(Plaid::class, $plaid);
    }

    public function testPlaidSingletonReturnsSameInstance(): void
    {
        $first = $this->app->make('plaid');
        $second = $this->app->make('plaid');

        $this->assertSame($first, $second);
    }
}
