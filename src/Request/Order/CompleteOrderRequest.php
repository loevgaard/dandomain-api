<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class CompleteOrderRequest extends Request
{
    /**
     * @var int
     */
    protected $orderId;

    public function __construct(int $orderId)
    {
        Assert::that($orderId)->greaterThan(0, 'The orderId must be positive');

        $this->orderId = $orderId;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/CompleteOrder/%d', $this->orderId));
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }
}
