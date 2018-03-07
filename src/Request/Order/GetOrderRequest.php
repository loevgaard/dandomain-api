<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Loevgaard\Dandomain\Api\Request\ObjectRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\OrderIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\OrderId;

class GetOrderRequest extends ObjectRequest
{
    use OrderIdTrait;

    public function __construct(OrderId $orderId)
    {
        $this->orderId = $orderId;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/%s', $this->orderId));
    }
}
