<?php
namespace Loevgaard\Dandomain\Api\Request;

use Loevgaard\Dandomain\Api\Response\BoolResponse;

/**
 * A request where the expected response is a boolean
 */
abstract class BoolRequest extends Request
{
    public function getResponseClass(): string
    {
        return BoolResponse::class;
    }
}
