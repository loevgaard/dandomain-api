<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Loevgaard\Dandomain\Api\Request\ObjectRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\EmailTrait;
use Loevgaard\Dandomain\Api\ValueObject\Email;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerByEmail_GET
 */
class GetCustomerByEmailRequest extends ObjectRequest
{
    use EmailTrait;

    public function __construct(Email $email)
    {
        $this->email = $email;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/GetCustomerByEmail?email=%s', rawurlencode($this->email)));
    }
}
