<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class GetGeneralDiscountRequest extends GetDiscountRequest
{
    public function __construct(int $id)
    {
        parent::__construct($id, DiscountType::TYPE_GENERAL);
    }
}
