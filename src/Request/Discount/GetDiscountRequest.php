<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

abstract class GetDiscountRequest extends Request
{
    public function __construct(int $id, string $type)
    {
        Assert::that($id)->greaterThan(0, 'The id must be positive');
        Assert::that($type)->choice(DiscountType::getTypes());

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s/%d', $type, $id));
    }
}
