<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class CountFreeShippingDiscountsRequest extends CountDiscountsRequest
{
    public function __construct(int $siteId)
    {
        parent::__construct($siteId, DiscountType::TYPE_FREE_SHIPPING);
    }
}
