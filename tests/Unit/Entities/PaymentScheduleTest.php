<?php

namespace Abivia\Plaid\Tests\Unit\Entities;

use Abivia\Plaid\Entities\PaymentSchedule;
use Abivia\Plaid\Tests\TestCase;
use Illuminate\Support\Carbon;
use InvalidArgumentException;

/**
 * @covers \Abivia\Plaid\Entities\PaymentSchedule
 */
class PaymentScheduleTest extends TestCase
{
	public function test_get_properties(): void
	{
		$paymentSchedule = new PaymentSchedule(
			PaymentSchedule::INTERVAL_MONTHLY,
			15,
			new Carbon('2020-10-01')
		);

		$this->assertEquals(
			'MONTHLY',
			$paymentSchedule->getInterval()
		);

		$this->assertEquals(15, $paymentSchedule->getIntervalExecutionDay());

		$this->assertEquals(
			'2020-10-01',
			$paymentSchedule->getStartDate()->format('Y-m-d')
		);
	}

	public function testInvalidIntervalThrowsInvalidArgumentException(): void
	{
		$this->expectException(InvalidArgumentException::class);
		new PaymentSchedule('YEARLY', 1, new Carbon('2020-01-01'));
	}
}
