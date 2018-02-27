<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomerDiscountPOST
 */
class UpdateCustomerDiscountRequest extends Request
{
    /**
     * @var int
     */
    protected $customerId;

    /**
     * @var array
     */
    protected $customerDiscount;

    public function __construct(int $customerId, array $customerDiscount)
    {
        Assert::that($customerId)->greaterThan(0, 'The $customerId has to be positive');
        Assert::that($customerDiscount)->notEmpty();

        $this->customerId = $customerId;
        $this->customerDiscount = $customerDiscount;

        parent::__construct(RequestInterface::METHOD_POST, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/UpdateCustomerDiscount/%d', $this->customerId), $this->customerDiscount);
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
    public function getCustomerDiscount(): array
    {
        return $this->customerDiscount;
    }
}
