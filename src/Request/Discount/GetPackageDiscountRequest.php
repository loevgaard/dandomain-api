<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

class GetPackageDiscountRequest extends GetDiscountRequest
{
    public function __construct(int $id)
    {
        parent::__construct($id, DiscountType::TYPE_PACKAGE);
    }
}
