<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class DeleteOrderRequest extends Request
{
    /**
     * @var int
     */
    protected $orderId;

    public function __construct(int $orderId)
    {
        Assert::that($orderId)->greaterThan(0, 'The orderId must be positive');

        $this->orderId = $orderId;

        parent::__construct(RequestInterface::METHOD_DELETE, sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/%d', $this->orderId));
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }
}
