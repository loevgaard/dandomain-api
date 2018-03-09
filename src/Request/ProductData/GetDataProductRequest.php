<?php
namespace Loevgaard\Dandomain\Api\Request\ProductData;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\ObjectRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\ProductNumberTrait;

class GetDataProductRequest extends ObjectRequest
{
    use ProductNumberTrait;

    public function __construct(string $productNumber)
    {
        Assert::that($productNumber)->minLength(1, 'The product number must not be empty');

        $this->productNumber = $productNumber;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s', rawurlencode($this->productNumber)));
    }
}
