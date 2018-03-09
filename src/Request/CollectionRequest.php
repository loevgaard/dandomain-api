<?php
namespace Loevgaard\Dandomain\Api\Request;

use Loevgaard\Dandomain\Api\Response\CollectionResponse;

/**
 * A request where the expected response is a collection
 */
abstract class CollectionRequest extends Request
{
    public function getResponseClass(): string
    {
        return CollectionResponse::class;
    }
}
