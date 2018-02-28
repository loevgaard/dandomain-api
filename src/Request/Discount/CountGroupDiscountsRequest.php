<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class CountGroupDiscountsRequest extends CountDiscountsRequest
{
    public function __construct(int $siteId)
    {
        parent::__construct($siteId, DiscountType::TYPE_GROUP);
    }
}
