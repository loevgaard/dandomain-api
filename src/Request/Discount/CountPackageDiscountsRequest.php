<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class CountPackageDiscountsRequest extends CountDiscountsRequest
{
    public function __construct(int $siteId)
    {
        parent::__construct($siteId, DiscountType::TYPE_PACKAGE);
    }
}
