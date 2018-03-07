<?php
namespace Loevgaard\Dandomain\Api\Traits;

trait DateTrait
{
    /**
     * @var \DateTimeInterface
     */
    protected $date;

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }
}
