<?php
namespace Loevgaard\Dandomain\Api\Request\Customer;

use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

/**
 * @see https://shoppartner.dandomain.dk/dokumentation/api-documentation/customer/#GetCustomerGroups_GET
 */
class GetCustomerGroupsRequest extends Request
{
    public function __construct()
    {
        parent::__construct(RequestInterface::METHOD_GET, '/admin/WEBAPI/Endpoints/v1_0/CustomerService/{KEY}/CustomerGroup');
    }
}
