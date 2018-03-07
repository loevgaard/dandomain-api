<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\CustomerId;

trait CustomerIdTrait
{
    /**
     * @var CustomerId
     */
    protected $customerId;

    /**
     * @return CustomerId
     */
    public function getCustomerId(): CustomerId
    {
        return $this->customerId;
    }
}
