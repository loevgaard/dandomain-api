<?php

namespace Loevgaard\Dandomain\Api\ValueObject;

abstract class StringLiteral
{
    /**
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return (string)$this->value;
    }

    public function get() : string
    {
        return $this->value;
    }
}
