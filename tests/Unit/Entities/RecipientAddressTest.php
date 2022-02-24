<?php

namespace Abivia\Plaid\Tests\Unit\Entities;

use Abivia\Plaid\Entities\RecipientAddress;
use Abivia\Plaid\Tests\TestCase;


/**
 * @covers \Abivia\Plaid\Entities\RecipientAddress
 */
class RecipientAddressTest extends TestCase
{
	public function testToArrayWithSingleStreet(): void
	{
		$address = new RecipientAddress('123 Elm St', null, 'Anytown', 'ABC 123', 'US');

		$this->assertEquals(
			[
				'street' => ['123 Elm St'],
				'city' => 'Anytown',
				'postal_code' => 'ABC 123',
				'country' => 'US'
			],
			$address->toArray()
		);
	}

	public function testToArrayWithAdditionalStreet(): void
	{
		$address = new RecipientAddress('123 Elm St', 'Apt A', 'Anytown', 'ABC 123', 'US');

		$this->assertEquals(
			[
				'street' => ['123 Elm St', 'Apt A'],
				'city' => 'Anytown',
				'postal_code' => 'ABC 123',
				'country' => 'US'
			],
			$address->toArray()
		);
	}
}
