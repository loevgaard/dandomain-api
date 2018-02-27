<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerByEmail_GET
 */
class GetCustomerByEmailRequest extends Request
{
    /**
     * @var string
     */
    protected $email;

    public function __construct(string $email)
    {
        Assert::that($email)->email();

        $this->email = $email;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/GetCustomerByEmail?email=%s', rawurlencode($this->email)));
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
