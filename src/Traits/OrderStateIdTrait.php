<?php
namespace Loevgaard\Dandomain\Api\Traits;

use Loevgaard\Dandomain\Api\ValueObject\OrderStateId;

trait OrderStateIdTrait
{
    /**
     * @var OrderStateId
     */
    protected $orderStateId;

    /**
     * @return OrderStateId
     */
    public function getOrderStateId(): OrderStateId
    {
        return $this->orderStateId;
    }
}
