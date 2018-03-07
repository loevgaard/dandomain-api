<?php

namespace Loevgaard\Dandomain\Api\ValueObject;

use Assert\Assert;

class Email extends StringLiteral
{
    public function __construct(string $value)
    {
        Assert::that($value)->email();

        parent::__construct($value);
    }
}