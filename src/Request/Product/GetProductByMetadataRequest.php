<?php
namespace Loevgaard\Dandomain\Api\Request\Product;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\ObjectRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\ProductNumberTrait;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductByMetadata
 */
class GetProductByMetadataRequest extends ObjectRequest
{
    use ProductNumberTrait;

    /**
     * @var array
     */
    protected $context;

    public function __construct(string $productNumber, array $context)
    {
        Assert::that($productNumber)->minLength(1, 'The product number must not be empty');
        Assert::that($context)->notEmpty();

        $this->productNumber = $productNumber;
        $this->context = $context;

        parent::__construct(
            RequestInterface::METHOD_POST,
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/%s', rawurlencode($this->productNumber)),
            $this->context
        );
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
