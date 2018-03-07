<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\CustomerIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\CustomerId;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomerDiscountPOST
 */
class UpdateCustomerDiscountRequest extends BoolRequest
{
    use CustomerIdTrait;

    public function __construct(CustomerId $customerId, array $customerDiscount)
    {
        Assert::that($customerDiscount)->notEmpty();

        $this->customerId = $customerId;

        parent::__construct(RequestInterface::METHOD_POST, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/UpdateCustomerDiscount/%s', $this->customerId), $customerDiscount);
    }
}
