<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomer_GET
 */
class GetCustomerRequest extends Request
{
    /**
     * @var int
     */
    protected $customerId;

    public function __construct(int $customerId)
    {
        Assert::that($customerId)->greaterThan(0, 'The $customerId has to be positive');

        $this->customerId = $customerId;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d', $this->customerId));
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }
}
