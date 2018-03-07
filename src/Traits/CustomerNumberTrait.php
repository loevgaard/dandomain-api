<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\CustomerNumber;

trait CustomerNumberTrait
{
    /**
     * @var CustomerNumber
     */
    protected $customerNumber;

    /**
     * @return CustomerNumber
     */
    public function getCustomerNumber(): CustomerNumber
    {
        return $this->customerNumber;
    }
}
