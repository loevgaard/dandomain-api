<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomer_PUT
 */
class UpdateCustomerRequest extends BoolRequest
{
    /**
     * @var int
     */
    protected $customerId;

    public function __construct(int $customerId, array $customer)
    {
        Assert::that($customerId)->greaterThan(0, 'The $customerId has to be positive');
        Assert::that($customer)->notEmpty();

        $this->customerId = $customerId;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d', $this->customerId), $customer);
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }
}
