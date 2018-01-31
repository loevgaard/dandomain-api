<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/DiscountService/help
 */
class Discount extends Endpoint
{
    const TYPE_FREE_SHIPPING = 'freeShippingSalesDiscount';
    const TYPE_GENERAL = 'generalSalesDiscount';
    const TYPE_GROUP = 'groupSalesDiscount';
    const TYPE_PACKAGE = 'packageSalesDiscount';
    const TYPE_QUANTITY = 'quantitySalesDiscount';

    /***************************
     * Free shipping discounts *
     **************************/

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function createFreeShippingDiscount($obj) : array
    {
        return $this->createDiscount($obj, self::TYPE_FREE_SHIPPING);
    }

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function updateFreeShippingDiscount($obj) : array
    {
        return $this->updateDiscount($obj, self::TYPE_FREE_SHIPPING);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getFreeShippingDiscount(int $id) : array
    {
        return $this->getDiscount($id, self::TYPE_FREE_SHIPPING);
    }

    /**
     * @param int $siteId
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getFreeShippingDiscounts(int $siteId, int $page = 1, int $pageSize = 100) : array
    {
        return $this->getDiscounts($siteId, $page, $pageSize, self::TYPE_FREE_SHIPPING);
    }

    /**
     * @param int $siteId
     * @return int
     */
    public function countFreeShippingDiscounts(int $siteId) : int
    {
        return $this->countDiscounts($siteId, self::TYPE_FREE_SHIPPING);
    }

    /*********************
     * General discounts *
     ********************/

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function createGeneralDiscount($obj) : array
    {
        return $this->createDiscount($obj, self::TYPE_GENERAL);
    }

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function updateGeneralDiscount($obj) : array
    {
        return $this->updateDiscount($obj, self::TYPE_GENERAL);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getGeneralDiscount(int $id) : array
    {
        return $this->getDiscount($id, self::TYPE_GENERAL);
    }

    /**
     * @param int $siteId
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getGeneralDiscounts(int $siteId, int $page = 1, int $pageSize = 100) : array
    {
        return $this->getDiscounts($siteId, $page, $pageSize, self::TYPE_GENERAL);
    }

    /**
     * @param int $siteId
     * @return int
     */
    public function countGeneralDiscounts(int $siteId) : int
    {
        return $this->countDiscounts($siteId, self::TYPE_GENERAL);
    }

    /**
     * Alias of countGeneralDiscounts
     *
     * @param int $siteId
     * @return int
     */
    public function countGeneralSalesDiscounts(int $siteId) : int
    {
        return $this->countGeneralDiscounts($siteId);
    }

    /*******************
     * Group discounts *
     ******************/

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function createGroupDiscount($obj) : array
    {
        return $this->createDiscount($obj, self::TYPE_GROUP);
    }

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function updateGroupDiscount($obj) : array
    {
        return $this->updateDiscount($obj, self::TYPE_GROUP);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getGroupDiscount(int $id) : array
    {
        return $this->getDiscount($id, self::TYPE_GROUP);
    }

    /**
     * @param int $siteId
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getGroupDiscounts(int $siteId, int $page = 1, int $pageSize = 100) : array
    {
        return $this->getDiscounts($siteId, $page, $pageSize, self::TYPE_GROUP);
    }

    /**
     * @param int $siteId
     * @return int
     */
    public function countGroupDiscounts(int $siteId) : int
    {
        return $this->countDiscounts($siteId, self::TYPE_GROUP);
    }

    /*********************
     * Package discounts *
     ********************/

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function createPackageDiscount($obj) : array
    {
        return $this->createDiscount($obj, self::TYPE_PACKAGE);
    }

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function updatePackageDiscount($obj) : array
    {
        return $this->updateDiscount($obj, self::TYPE_PACKAGE);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getPackageDiscount(int $id) : array
    {
        return $this->getDiscount($id, self::TYPE_PACKAGE);
    }

    /**
     * @param int $siteId
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getPackageDiscounts(int $siteId, int $page = 1, int $pageSize = 100) : array
    {
        return $this->getDiscounts($siteId, $page, $pageSize, self::TYPE_PACKAGE);
    }

    /**
     * @param int $siteId
     * @return int
     */
    public function countPackageDiscounts(int $siteId) : int
    {
        return $this->countDiscounts($siteId, self::TYPE_PACKAGE);
    }

    /**
     * Alias of countPackageDiscounts
     *
     * @param int $siteId
     * @return int
     */
    public function countPackageSalesDiscounts(int $siteId) : int
    {
        return $this->countPackageDiscounts($siteId);
    }

    /**********************
     * Quantity discounts *
     *********************/

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function createQuantityDiscount($obj) : array
    {
        return $this->createDiscount($obj, self::TYPE_QUANTITY);
    }

    /**
     * @param array|\stdClass $obj
     * @return array
     */
    public function updateQuantityDiscount($obj) : array
    {
        return $this->updateDiscount($obj, self::TYPE_QUANTITY);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getQuantityDiscount(int $id) : array
    {
        return $this->getDiscount($id, self::TYPE_QUANTITY);
    }

    /**
     * @param int $siteId
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getQuantityDiscounts(int $siteId, int $page = 1, int $pageSize = 100) : array
    {
        return $this->getDiscounts($siteId, $page, $pageSize, self::TYPE_QUANTITY);
    }

    /**
     * @param int $siteId
     * @return int
     */
    public function countQuantityDiscounts(int $siteId) : int
    {
        return $this->countDiscounts($siteId, self::TYPE_QUANTITY);
    }

    /**
     * Alias of countQuantityDiscounts
     *
     * @param int $siteId
     * @return int
     */
    public function countQuantitySalesDiscounts(int $siteId) : int
    {
        return $this->countQuantityDiscounts($siteId);
    }

    /**
     * Deletes a sales discount
     *
     * @param int $id
     * @return bool
     */
    public function deleteSalesDiscount(int $id) : bool
    {
        Assert::that($id)->greaterThan(0, '$id must be positive');

        return (bool)$this->master->doRequest(
            'DELETE',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/salesDiscount/%d', $id)
        );
    }

    /*
     * Helper methods
     */
    protected function createDiscount($obj, string $type) : array
    {
        Assert::that($type)->choice(self::getTypes());

        return (array)$this->master->doRequest(
            'POST',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s', $type),
            $obj
        );
    }

    protected function updateDiscount($obj, string $type) : array
    {
        Assert::that($type)->choice(self::getTypes());

        return (array)$this->master->doRequest(
            'PUT',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s', $type),
            $obj
        );
    }

    protected function getDiscount(int $id, string $type) : array
    {
        Assert::that($id)->greaterThan(0, '$id must be positive');
        Assert::that($type)->choice(self::getTypes());

        return (array)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s/%d', $type, $id)
        );
    }

    protected function getDiscounts(int $siteId, int $page, int $pageSize, string $type) : array
    {
        Assert::that($siteId)->greaterThan(0, '$siteId must be positive');
        Assert::that($page)->greaterThan(0, '$page must be positive');
        Assert::that($pageSize)->greaterThan(0, '$pageSize must be positive');
        Assert::that($type)->choice(self::getTypes());

        $type .= 's';

        return (array)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s/%d/%d/%d', $type, $siteId, $page, $pageSize)
        );
    }

    protected function countDiscounts(int $siteId, string $type) : int
    {
        Assert::that($siteId)->greaterThan(0, '$siteId must be positive');
        Assert::that($type)->choice(self::getTypes());

        $type .= 'sCount';

        return (int)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/DiscountService/{KEY}/%s/%d', $type, $siteId)
        );
    }

    protected static function getTypes() : array
    {
        return [
            self::TYPE_FREE_SHIPPING => self::TYPE_FREE_SHIPPING,
            self::TYPE_GENERAL => self::TYPE_GENERAL,
            self::TYPE_GROUP => self::TYPE_GROUP,
            self::TYPE_PACKAGE => self::TYPE_PACKAGE,
            self::TYPE_QUANTITY => self::TYPE_QUANTITY,
        ];
    }
}
