<?php
namespace Loevgaard\Dandomain\Api\DateTime;

use Loevgaard\Dandomain\Api\Exception\DateIntervalException;
use Loevgaard\DandomainDateTime\DateTimeImmutable;

class DateInterval
{
    /**
     * @var DateTimeImmutable
     */
    protected $start;

    /**
     * @var DateTimeImmutable
     */
    protected $end;

    /**
     * DateInterval constructor.
     * @param DateTimeImmutable $start
     * @param DateTimeImmutable $end
     * @throws DateIntervalException
     */
    public function __construct(DateTimeImmutable $start, DateTimeImmutable $end)
    {
        $now = new DateTimeImmutable();
        if ($end > $now) {
            $end = $now;
        }

        if ($start > $end) {
            throw new DateIntervalException('Start date is after end date. This is wrong.');
        }

        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStart(): DateTimeImmutable
    {
        return $this->start;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEnd(): DateTimeImmutable
    {
        return $this->end;
    }
}
