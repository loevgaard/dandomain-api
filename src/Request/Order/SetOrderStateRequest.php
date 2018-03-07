<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class SetOrderStateRequest extends BoolRequest
{
    /**
     * @var int
     */
    protected $orderId;

    /**
     * @var int
     */
    protected $orderState;

    public function __construct(int $orderId, int $orderState)
    {
        Assert::that($orderId)->greaterThan(0, 'The orderId must be positive');
        Assert::that($orderState)->greaterThan(0, 'The orderState must be positive');

        $this->orderId = $orderId;
        $this->orderState = $orderState;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/SetOrderState/%d/%d', $this->orderId, $this->orderState));
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return int
     */
    public function getOrderState(): int
    {
        return $this->orderState;
    }
}
