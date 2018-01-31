<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;

class Discount extends Endpoint
{
    /**
     * @param int $siteId
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getGeneralDiscounts(int $siteId, int $page = 1, int $pageSize = 100) : array
    {
        Assert::that($siteId)->integer()->greaterThan(0, '$siteId must be positive');
        Assert::that($page)->integer()->greaterThan(0, '$page must be positive');
        Assert::that($pageSize)->integer()->greaterThan(0, '$pageSize must be positive');

        return (array)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/generalSalesDiscounts/%d/%d/%d', $siteId, $page, $pageSize)
        );
    }

    /**
     * @param int $siteId
     * @return int
     */
    public function countGeneralSalesDiscounts(int $siteId) : int
    {
        Assert::that($siteId)->greaterThan(0, '$siteId must be positive');

        return (int)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/generalSalesDiscountsCount/%d', $siteId)
        );
    }
}
