<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#CreateCustomer_POST
 */
class CreateCustomerRequest extends Request
{
    public function __construct(array $customer)
    {
        Assert::that($customer)->notEmpty();

        parent::__construct(RequestInterface::METHOD_POST, '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}', $customer);
    }
}
