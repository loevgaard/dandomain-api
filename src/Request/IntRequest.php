<?php
namespace Loevgaard\Dandomain\Api\Request;

use Loevgaard\Dandomain\Api\Response\IntResponse;

abstract class IntRequest extends Request
{
    public function getResponseClass(): string
    {
        return IntResponse::class;
    }
}
