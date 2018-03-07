<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\CustomerNumberTrait;
use Loevgaard\Dandomain\Api\ValueObject\CustomerNumber;

class GetOrdersByCustomerNumberRequest extends CollectionRequest
{
    use CustomerNumberTrait;

    public function __construct(CustomerNumber $customerNumber)
    {
        $this->customerNumber = $customerNumber;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/GetByCustomerNumber/%s', $this->customerNumber));
    }
}
