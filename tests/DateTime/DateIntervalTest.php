<?php
namespace Loevgaard\Dandomain\Api\DateTime;

use Loevgaard\Dandomain\Api\Exception\DateIntervalException;
use Loevgaard\DandomainDateTime\DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class DateIntervalTest extends TestCase
{
    public function testGetters()
    {
        $dt1 = new DateTimeImmutable();
        $dt2 = new DateTimeImmutable();
        $dateInterval = new DateInterval($dt1, $dt2);

        $this->assertSame($dt1, $dateInterval->getStart());
        $this->assertSame($dt2, $dateInterval->getEnd());
    }

    public function testEndAfterNow()
    {
        $dt1 = DateTimeImmutable::createFromFormat('Y-m-d', '2018-01-01');
        $dt2 = DateTimeImmutable::createFromFormat('Y-m-d', '2100-01-01');
        $dateInterval = new DateInterval($dt1, $dt2);

        $this->assertNotEquals($dt2, $dateInterval->getEnd());
    }

    public function testException()
    {
        $this->expectException(DateIntervalException::class);
        $dt1 = DateTimeImmutable::createFromFormat('Y-m-d', '2018-01-01');
        $dt2 = DateTimeImmutable::createFromFormat('Y-m-d', '2017-01-01');
        new DateInterval($dt1, $dt2);
    }
}
