<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\CustomerIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\CustomerId;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomer_PUT
 */
class UpdateCustomerRequest extends BoolRequest
{
    use CustomerIdTrait;

    /**
     * @var array
     */
    protected $customer;

    public function __construct(CustomerId $customerId, array $customer)
    {
        Assert::that($customer)->notEmpty();

        $this->customerId = $customerId;
        $this->customer = $customer;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%s', $this->customerId), $this->customer);
    }

    /**
     * @return array
     */
    public function getCustomer(): array
    {
        return $this->customer;
    }
}
