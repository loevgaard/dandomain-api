<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class UpdateGeneralDiscountRequest extends UpdateDiscountRequest
{
    public function __construct(array $discount)
    {
        parent::__construct($discount, DiscountType::TYPE_GENERAL);
    }
}
