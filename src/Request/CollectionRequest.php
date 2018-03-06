<?php
namespace Loevgaard\Dandomain\Api\Request;

use Loevgaard\Dandomain\Api\Response\CollectionResponse;

abstract class CollectionRequest extends Request
{
    public function getResponseClass(): string
    {
        return CollectionResponse::class;
    }
}
