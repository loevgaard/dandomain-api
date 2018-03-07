<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\DateTime\DateInterval;

trait DateIntervalTrait
{
    /**
     * @var DateInterval
     */
    protected $dateInterval;

    /**
     * @return DateInterval
     */
    public function getDateInterval(): DateInterval
    {
        return $this->dateInterval;
    }
}
