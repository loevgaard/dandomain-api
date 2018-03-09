<?php
namespace Loevgaard\Dandomain\Api\Request;

use Loevgaard\Dandomain\Api\Response\IntResponse;

/**
 * A request where the expected response is an int
 */
abstract class IntRequest extends Request
{
    public function getResponseClass(): string
    {
        return IntResponse::class;
    }
}
