<?php
namespace Loevgaard\Dandomain\Api\Request\RelatedData;

use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class GetManufacturersRequest extends CollectionRequest
{
    public function __construct()
    {
        parent::__construct(RequestInterface::METHOD_GET, '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Manufacturers');
    }
}
