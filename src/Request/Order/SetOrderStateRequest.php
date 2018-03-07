<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\OrderIdTrait;
use Loevgaard\Dandomain\Api\Traits\OrderStateIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\OrderId;
use Loevgaard\Dandomain\Api\ValueObject\OrderStateId;

class SetOrderStateRequest extends BoolRequest
{
    use OrderIdTrait;
    use OrderStateIdTrait;

    public function __construct(OrderId $orderId, OrderStateId $orderState)
    {
        $this->orderId = $orderId;
        $this->orderStateId = $orderState;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetOrderState/%s/%s', $this->orderId, $this->orderStateId));
    }
}
