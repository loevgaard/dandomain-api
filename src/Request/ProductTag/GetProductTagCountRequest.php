<?php
namespace Loevgaard\Dandomain\Api\Request\RelatedData;

use Loevgaard\Dandomain\Api\Request\IntRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

class GetProductTagCountRequest extends IntRequest
{
    public function __construct()
    {
        parent::__construct(RequestInterface::METHOD_GET, '/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagCount');
    }
}
