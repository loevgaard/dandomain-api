<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\OrderId;

trait OrderIdTrait
{
    /**
     * @var OrderId
     */
    protected $orderId;

    /**
     * @return OrderId
     */
    public function getOrderId(): OrderId
    {
        return $this->orderId;
    }
}
