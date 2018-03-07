<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class GetOrdersByCustomerNumberRequest extends CollectionRequest
{
    /**
     * @var int
     */
    protected $customerNumber;

    public function __construct(int $customerNumber)
    {
        Assert::that($customerNumber)->greaterThan(0, 'The customerNumber must be positive');

        $this->customerNumber = $customerNumber;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByCustomerNumber/%d', $this->customerNumber));
    }

    /**
     * @return int
     */
    public function getCustomerNumber(): int
    {
        return $this->customerNumber;
    }
}
