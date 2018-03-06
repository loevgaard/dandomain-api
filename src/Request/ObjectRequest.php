<?php
namespace Loevgaard\Dandomain\Api\Request;

use Loevgaard\Dandomain\Api\Response\ObjectResponse;

abstract class ObjectRequest extends Request
{
    public function getResponseClass(): string
    {
        return ObjectResponse::class;
    }
}
