<?php
namespace Loevgaard\Dandomain\Api\Request\Product;

use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\SiteIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\SiteId;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetCategories
 */
class GetCategoriesRequest extends CollectionRequest
{
    use SiteIdTrait;

    public function __construct(SiteId $siteId)
    {
        $this->siteId = $siteId;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Categories/%s', $this->siteId));
    }
}
