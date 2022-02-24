<?php

namespace Abivia\Plaid\Tests\Unit\Entities;

use Abivia\Plaid\Entities\AccountFilters;
use Abivia\Plaid\Tests\TestCase;
use ReflectionClass;

/**
 * @covers \Abivia\Plaid\Entities\AccountFilters
 */
class AccountFiltersTest extends TestCase
{
    public function testConstructorSetsFilters(): void
    {
        $filters = [
            'depository' => ['auth', 'identity']
        ];

        $accountFilters = new AccountFilters($filters);

        $this->assertEquals(
            [
                'depository' => [
                    'account_subtypes' => ['auth', 'identity']
                ]
            ],
            $accountFilters->toArray()
        );
    }

    public function testSetFilterIgnoresEmptySubtypeArray(): void
    {
        $accountFilters = new AccountFilters;

        $reflectionClass = new ReflectionClass($accountFilters);
        $reflectionMethod = $reflectionClass->getMethod('setFilter');
        $reflectionMethod->setAccessible(true);

        $reflectionMethod->invokeArgs($accountFilters, ['loan', []]);

        $this->assertEmpty(
            $accountFilters->toArray()
        );
    }

    public function testSetDepositoryFilters(): void
    {
        $accountFilters = new AccountFilters;
        $accountFilters->setDepositoryFilters(['auth', 'transactions', 'identity', 'income', 'assets']);

        $this->assertEquals(
            [
                'depository' => [
                    'account_subtypes' => ['auth', 'transactions', 'identity', 'income', 'assets']
                ]
            ],
            $accountFilters->toArray()
        );
    }

    public function testSetCreditFilters(): void
    {
        $accountFilters = new AccountFilters;
        $accountFilters->setCreditFilters(['transactions', 'identity', 'liabilities']);

        $this->assertEquals(
            [
                'credit' => [
                    'account_subtypes' => ['transactions', 'identity', 'liabilities']
                ]
            ],
            $accountFilters->toArray()
        );
    }

    public function testSetInvestmentFilters(): void
    {
        $accountFilters = new AccountFilters;
        $accountFilters->setInvestmentFilters(['investments']);

        $this->assertEquals(
            [
                'investment' => [
                    'account_subtypes' => ['investments']
                ]
            ],
            $accountFilters->toArray()
        );
    }

    public function testSetLoanFilters(): void
    {
        $accountFilters = new AccountFilters;
        $accountFilters->setLoanFilters(['transactions', 'liabilities']);

        $this->assertEquals(
            [
                'loan' => [
                    'account_subtypes' => ['transactions', 'liabilities']
                ]
            ],
            $accountFilters->toArray()
        );
    }

    public function testSetOtherFilters(): void
    {
        $accountFilters = new AccountFilters;
        $accountFilters->setOtherFilters(['auth', 'transactions', 'identity', 'assets']);

        $this->assertEquals(
            [
                'other' => [
                    'account_subtypes' => ['auth', 'transactions', 'identity', 'assets']
                ]
            ],
            $accountFilters->toArray()
        );
    }
}
