<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\ObjectRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class CreateOrderRequest extends ObjectRequest
{
    /**
     * @var array
     */
    protected $order;

    public function __construct(array $order)
    {
        Assert::that($order)->notEmpty();

        $this->order = $order;

        parent::__construct(RequestInterface::METHOD_POST, '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}', $order);
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }
}
