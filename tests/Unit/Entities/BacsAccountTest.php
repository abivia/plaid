<?php
namespace Abivia\Plaid\Tests\Unit\Entities;

use Abivia\Plaid\Entities\BacsAccount;
use Abivia\Plaid\Tests\TestCase;

/**
 * @covers \Abivia\Plaid\Entities\BacsAccount
 */
class BacsAccountTest extends TestCase
{
	public function testConstructorSetsAccountAndSortCode(): void
	{
		$bacsAccount = new BacsAccount('account', 'sort_code');

		$this->assertEquals(
			[
				'account' => 'account',
				'sort_code' => 'sort_code'
			],
			$bacsAccount->toArray()
		);
	}
}
