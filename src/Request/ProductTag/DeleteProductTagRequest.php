<?php
namespace Loevgaard\Dandomain\Api\Request\RelatedData;

use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\ProductTagIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\ProductTagId;

class DeleteProductTagRequest extends BoolRequest
{
    use ProductTagIdTrait;

    public function __construct(ProductTagId $productTagId)
    {
        $this->productTagId = $productTagId;

        parent::__construct(RequestInterface::METHOD_DELETE, sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/%s', $this->productTagId));
    }
}
