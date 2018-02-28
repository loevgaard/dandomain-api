<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class GetQuantityDiscountRequest extends GetDiscountRequest
{
    public function __construct(int $id)
    {
        parent::__construct($id, DiscountType::TYPE_QUANTITY);
    }
}
