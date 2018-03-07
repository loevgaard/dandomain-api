<?php
namespace Loevgaard\Dandomain\Api\Request\Product;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\ObjectRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\ProductNumberTrait;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProduct
 */
class GetProductRequest extends ObjectRequest
{
    use ProductNumberTrait;

    /**
     * @var int
     */
    protected $siteId;

    public function __construct(string $productNumber, int $siteId)
    {
        Assert::that($productNumber)->minLength(1, 'The product number must not be empty');
        Assert::that($siteId)->greaterThan(0, 'The site id must be positive');

        $this->productNumber = $productNumber;
        $this->siteId = $siteId;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/%s/%d', rawurlencode($this->productNumber), $this->siteId));
    }

    /**
     * @return int
     */
    public function getSiteId(): int
    {
        return $this->siteId;
    }
}
