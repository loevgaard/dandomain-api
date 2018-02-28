<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class UpdateFreeShippingDiscountRequest extends UpdateDiscountRequest
{
    public function __construct(array $discount)
    {
        parent::__construct($discount, DiscountType::TYPE_FREE_SHIPPING);
    }
}
