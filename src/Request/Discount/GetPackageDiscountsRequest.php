<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class GetPackageDiscountsRequest extends GetDiscountsRequest
{
    public function __construct(int $siteId, int $page = 1, int $pageSize = 100)
    {
        parent::__construct($siteId, $page, $pageSize, DiscountType::TYPE_PACKAGE);
    }
}
