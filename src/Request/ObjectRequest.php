<?php
namespace Loevgaard\Dandomain\Api\Request;

use Loevgaard\Dandomain\Api\Response\ObjectResponse;

/**
 * A request where the expected response is an entity/object
 */
abstract class ObjectRequest extends Request
{
    public function getResponseClass(): string
    {
        return ObjectResponse::class;
    }
}
