<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomer_PUT
 */
class UpdateCustomerRequest extends Request
{
    /**
     * @var int
     */
    protected $customerId;

    /**
     * @var array
     */
    protected $customer;

    public function __construct(int $customerId, array $customer)
    {
        Assert::that($customer)->notEmpty();
        Assert::that($customerId)->greaterThan(0, 'The $customerId has to be positive');

        $this->customerId = $customerId;
        $this->customer = $customer;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d', $this->customerId), $this->customer);
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return array
     */
    public function getCustomer(): array
    {
        return $this->customer;
    }
}
