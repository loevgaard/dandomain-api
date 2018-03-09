<?php

namespace Loevgaard\Dandomain\Api\ValueObject;

use Assert\Assert;

abstract class PositiveInteger
{
    /**
     * @var int
     */
    protected $value;

    public function __construct(int $value)
    {
        Assert::that($value)->greaterThan(0);

        $this->value = $value;
    }

    public function __toString()
    {
        return (string)$this->value;
    }

    public function get() : int
    {
        return $this->value;
    }
}
