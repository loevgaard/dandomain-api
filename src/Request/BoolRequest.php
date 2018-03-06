<?php
namespace Loevgaard\Dandomain\Api\Request;

use Loevgaard\Dandomain\Api\Response\BoolResponse;

abstract class BoolRequest extends Request
{
    public function getResponseClass(): string
    {
        return BoolResponse::class;
    }
}
