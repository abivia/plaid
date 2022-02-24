<?php
declare(strict_types=1);

namespace Abivia\Plaid\Entities;

use Illuminate\Support\Carbon;
use InvalidArgumentException;

class PaymentSchedule
{
    const INTERVAL_WEEKLY = 'WEEKLY';
    const INTERVAL_MONTHLY = 'MONTHLY';

    /**
     * @var string Payment schedule interval.
     */
    protected string $interval;

    /**
     * @var int Payment schedule execution day.
     */
    protected int $intervalExecutionDay;

    /**
     * @var Carbon Start date of scheduled payments.
     */
    protected Carbon $startDate;

    /**
     * @param string $interval You can use the class constants PaymentSchedule::WEEKLY and PaymentScheduler::MONTHLY.
     * @param integer $intervalExecutionDay
     * @param Carbon $startDate
     * @throws InvalidArgumentException
     */
    public function __construct(
        string   $interval,
        int      $intervalExecutionDay,
        Carbon $startDate)
    {
        $interval = strtoupper($interval);
        if (!\in_array($interval, [self::INTERVAL_MONTHLY, self::INTERVAL_WEEKLY])) {
            throw new InvalidArgumentException('Interval must be WEEKLY or MONTHLY.');
        }

        $this->interval = $interval;
        $this->intervalExecutionDay = $intervalExecutionDay;
        $this->startDate = $startDate;
    }

    /**
     * Get the payment schedule interval.
     *
     * @return string
     */
    public function getInterval(): string
    {
        return $this->interval;
    }

    /**
     * Get the interval execution day.
     *
     * @return integer
     */
    public function getIntervalExecutionDay(): int
    {
        return $this->intervalExecutionDay;
    }

    /**
     * Get the start date of the scheduled payment.
     *
     * @return Carbon
     */
    public function getStartDate(): Carbon
    {
        return $this->startDate;
    }
}
