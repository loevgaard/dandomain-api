<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Api;

class Customer extends Endpoint
{

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomer_GET
     *
     * @param int $customerId
     * @return array
     */
    public function getCustomer(int $customerId) : array
    {
        Assert::that($customerId)->greaterThan(0);

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d',
                $customerId
            )
        );
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerByEmail_GET
     *
     * @param string $email
     * @return array
     */
    public function getCustomerByEmail(string $email) : array
    {
        Assert::that($email)->email();

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/GetCustomerByEmail?email=%s',
                rawurlencode($email)
            )
        );
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#CreateCustomer_POST
     *
     * @param array|\stdClass $customer
     * @return array
     */
    public function createCustomer($customer) : array
    {
        return $this->master->doRequest(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}',
            ['json' => $customer]
        );
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomer_PUT
     *
     * @param int $customerId
     * @param array|\stdClass $customer
     * @return array
     */
    public function updateCustomer(int $customerId, $customer) : array
    {
        Assert::that($customerId)->greaterThan(0);

        return $this->master->doRequest(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d',
                $customerId
            ),
            ['json' => $customer]
        );
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#DeleteCustomer_DELETE
     *
     * @param int $customerId
     * @return boolean
     */
    public function deleteCustomer(int $customerId) : boolean
    {
        Assert::that($customerId)->greaterThan(0);

        return $this->master->doRequest(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d',
                $customerId
            )
        );
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerGroups_GET
     *
     * @return array
     */
    public function getCustomerGroups() : array
    {
        return $this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/CustomerGroup'
        );
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomerDiscountPOST
     *
     * @param int $customerId
     * @param array|\stdClass $customerDiscount
     * @return array
     */
    public function updateCustomerDiscount(int $customerId, $customerDiscount) : array
    {
        Assert::that($customerId)->greaterThan(0);

        return $this->master->doRequest(
            'POST',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/UpdateCustomerDiscount/%d',
                $customerId
            ),
            ['json' => $customerDiscount]
        );
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerDiscountGET
     *
     * @param int $customerId
     * @return array
     */
    public function getCustomerDiscount(int $customerId) : array
    {
        Assert::that($customerId)->greaterThan(0);

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/GetCustomerDiscount/%d',
                $customerId
            )
        );
    }
}
