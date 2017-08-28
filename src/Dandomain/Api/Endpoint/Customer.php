<?php
namespace Dandomain\Api\Endpoint;

use Dandomain\Api\Api;
use Assert\Assert;

class Customer extends Endpoint {
    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomer_GET
     *
     * @param int $customerId
     * @return \stdClass
     */
    public function getCustomer(int $customerId) : \stdClass
    {
        Assert::that($customerId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d',
                $customerId
            )
        ));
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerByEmail_GET
     *
     * @param string $email
     * @return \stdClass
     */
    public function getCustomerByEmail(string $email) : \stdClass
    {
        Assert::that($email)->email();

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/GetCustomerByEmail?email=%s',
                rawurlencode($email)
            )
        ));
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#CreateCustomer_POST
     *
     * @param array|\stdClass $customer
     * @return \stdClass
     */
    public function createCustomer($customer) : \stdClass
    {
        return Api::decodeResponse($this->master->request(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}',
            ['json' => $customer]
        ));
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomer_PUT
     *
     * @param int $customerId
     * @param array|\stdClass $customer
     * @return \stdClass
     */
    public function updateCustomer(int $customerId, $customer) : \stdClass
    {
        Assert::that($customerId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d',
                $customerId
            ),
            ['json' => $customer]
        ));
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

        $resp = Api::decodeResponse($this->master->request(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d',
                $customerId
            )
        ));

        return $resp === 'true';
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerGroups_GET
     *
     * @return array
     */
    public function getCustomerGroups() : array
    {
        return Api::decodeResponse($this->master->request(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/CustomerGroup'
        ));
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomerDiscountPOST
     *
     * @param int $customerId
     * @param array|\stdClass $customerDiscount
     * @return \stdClass
     */
    public function updateCustomerDiscount(int $customerId, $customerDiscount) : \stdClass
    {
        Assert::that($customerId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'POST',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/UpdateCustomerDiscount/%d',
                $customerId
            ),
            ['json' => $customerDiscount]
        ));
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerDiscountGET
     *
     * @param int $customerId
     * @return \stdClass
     */
    public function getCustomerDiscount(int $customerId) : \stdClass
    {
        Assert::that($customerId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/GetCustomerDiscount/%d',
                $customerId
            )
        ));
    }
}