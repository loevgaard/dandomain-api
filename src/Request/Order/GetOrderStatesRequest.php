<?php
namespace Loevgaard\Dandomain\Api\Request\Order;

use Loevgaard\Dandomain\Api\Request\Request;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class GetOrderStatesRequest extends Request
{
    public function __construct()
    {
        parent::__construct(RequestInterface::METHOD_GET, '/admin/WEBAPI/Endpoints/v1_0/OrderService/{KEY}/OrderStates');
    }
}
