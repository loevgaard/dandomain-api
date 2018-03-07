<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\CustomerIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\CustomerId;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#DeleteCustomer_DELETE
 */
class DeleteCustomerRequest extends BoolRequest
{
    use CustomerIdTrait;

    public function __construct(CustomerId $customerId)
    {
        $this->customerId = $customerId;

        parent::__construct(RequestInterface::METHOD_DELETE, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%s', $this->customerId));
    }
}
