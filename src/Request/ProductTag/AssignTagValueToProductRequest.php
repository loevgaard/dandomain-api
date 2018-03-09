<?php
namespace Loevgaard\Dandomain\Api\Request\RelatedData;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\BoolRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\ProductNumberTrait;
use Loevgaard\Dandomain\Api\Traits\ProductTagValueIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\ProductTagValueId;

class AssignTagValueToProductRequest extends BoolRequest
{
    use ProductNumberTrait;
    use ProductTagValueIdTrait;

    public function __construct(string $productNumber, ProductTagValueId $productTagValueId)
    {
        Assert::that($productNumber)->minLength(1, 'The product number must not be empty');

        $this->productNumber = $productNumber;
        $this->productTagValueId = $productTagValueId;

        parent::__construct(RequestInterface::METHOD_PUT, sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/AssignTagValueToProduct/%s/%s', rawurlencode($this->productNumber), $this->productTagValueId));
    }
}
