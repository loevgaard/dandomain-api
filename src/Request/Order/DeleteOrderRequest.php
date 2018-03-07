<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\OrderIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\OrderId;

class DeleteOrderRequest extends BoolRequest
{
    use OrderIdTrait;

    public function __construct(OrderId $orderId)
    {
        $this->orderId = $orderId;

        parent::__construct(RequestInterface::METHOD_DELETE, sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/%s', $this->orderId));
    }
}
