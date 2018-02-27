<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

abstract class GetDiscountRequest extends Request
{
    public function __construct()
    {
        parent::__construct(RequestInterface::METHOD_GET);
    }
}
