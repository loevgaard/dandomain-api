<?php
namespace Loevgaard\Dandomain\Api\Request\Product;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\CategoryIdTrait;
use Loevgaard\Dandomain\Api\Traits\ContextTrait;
use Loevgaard\Dandomain\Api\ValueObject\CategoryId;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductsInCategoryByMetadata
 */
class GetProductsInCategoryByMetadataRequest extends CollectionRequest
{
    use CategoryIdTrait;
    use ContextTrait;

    public function __construct(CategoryId $categoryId, array $context)
    {
        Assert::that($context)->notEmpty();

        $this->categoryId = $categoryId;
        $this->context = $context;

        parent::__construct(
            RequestInterface::METHOD_POST,
            sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Products/%s', $this->categoryId),
            $this->context
        );
    }
}
