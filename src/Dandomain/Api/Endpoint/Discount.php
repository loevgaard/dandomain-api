<?php
namespace Dandomain\Api\Endpoint;

use Assert\Assert;
use Psr\Http\Message\ResponseInterface;

class Discount extends Endpoint {
    /**
     * @param int $siteId
     * @param int $page
     * @param int $pageSize
     * @return ResponseInterface
     */
    public function getGeneralDiscounts($siteId, $page, $pageSize) {
        Assert::that($siteId)->integer()->greaterThan(0);
        Assert::that($page)->integer()->greaterThan(0);
        Assert::that($pageSize)->integer()->greaterThan(0);

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/generalSalesDiscounts/%d/%d/%d',
                $siteId, $page, $pageSize
            )
        );
    }

    /**
     * @param $siteId
     * @return int
     */
    public function countGeneralSalesDiscounts($siteId) {
        Assert::that($siteId)->integer()->greaterThan(0);

        $response = $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/generalSalesDiscountsCount/%d',
                $siteId
            )
        );

        return (int)\GuzzleHttp\json_decode((string)$response->getBody());
    }


}