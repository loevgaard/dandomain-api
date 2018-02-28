<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class DiscountType
{
    const TYPE_FREE_SHIPPING = 'freeShippingSalesDiscount';
    const TYPE_GENERAL = 'generalSalesDiscount';
    const TYPE_GROUP = 'groupSalesDiscount';
    const TYPE_PACKAGE = 'packageSalesDiscount';
    const TYPE_QUANTITY = 'quantitySalesDiscount';

    public static function getTypes() : array
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
