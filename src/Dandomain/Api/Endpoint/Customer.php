<?php
namespace Dandomain\Api\Endpoint;

use Assert\Assert;
use Psr\Http\Message\ResponseInterface;

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

        return $this->master->decodeResponse($this->master->call(
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

        return $this->master->decodeResponse($this->master->call(
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
     * @return ResponseInterface
     */
    public function createCustomer($customer) : ResponseInterface
    {
        return $this->master->call(
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
     * @return ResponseInterface
     */
    public function updateCustomer(int $customerId, $customer) : ResponseInterface
    {
        Assert::that($customerId)->greaterThan(0);

        return $this->master->call(
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
     * @return ResponseInterface
     */
    public function deleteCustomer(int $customerId) : ResponseInterface
    {
        Assert::that($customerId)->greaterThan(0);

        return $this->master->decodeResponse($this->master->call(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/%d',
                $customerId
            )
        ));
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerGroups_GET
     *
     * @return array
     */
    public function getCustomerGroups() : array
    {
        return $this->master->decodeResponse($this->master->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/CustomerGroup'
        ));
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#UpdateCustomerDiscountPOST
     *
     * @param int $customerId
     * @param array|\stdClass $customerDiscount
     * @return ResponseInterface
     */
    public function updateCustomerDiscount(int $customerId, $customerDiscount) {
        Assert::that($customerId)->greaterThan(0);

        return $this->master->call(
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
     * @return \stdClass
     */
    public function getCustomerDiscount(int $customerId) : \stdClass
    {
        Assert::that($customerId)->greaterThan(0);

        return $this->master->decodeResponse($this->master->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/GetCustomerDiscount/%d',
                $customerId
            )
        ));
    }
}