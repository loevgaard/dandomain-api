<?php
namespace Loevgaard\Dandomain\Api\Request\Product;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\SiteIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\SiteId;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductsByBarcode
 */
class GetProductsByBarcodeRequest extends CollectionRequest
{
    use SiteIdTrait;

    /**
     * @var string
     */
    protected $barCode;

    public function __construct(string $barCode, SiteId $siteId)
    {
        Assert::that($barCode)->minLength(1, 'The bar code must not be empty');

        $this->barCode = $barCode;
        $this->siteId = $siteId;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/ByBarcode/%s/%d', rawurlencode($this->barCode), $this->siteId));
    }

    /**
     * @return string
     */
    public function getBarCode(): string
    {
        return $this->barCode;
    }
}
