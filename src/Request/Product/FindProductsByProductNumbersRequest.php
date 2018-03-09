<?php
namespace Loevgaard\Dandomain\Api\Request\Product;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\PagingTrait;
use Loevgaard\Dandomain\Api\Traits\SiteIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\SiteId;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/FindProductsByProductNumbers
 */
class FindProductsByProductNumbersRequest extends CollectionRequest
{
    use SiteIdTrait;
    use PagingTrait;

    /**
     * @var array
     */
    protected $productNumbers;

    public function __construct(SiteId $siteId, array $productNumbers, int $page = 1, int $pageSize = 100)
    {
        Assert::thatAll($productNumbers)->minLength(1, 'All product numbers in product numbers must have a length > 0');
        Assert::that($page)->greaterThan(0, 'The page has to be positive');
        Assert::that($pageSize)->greaterThan(0, 'The page size has to be positive');

        $this->siteId = $siteId;
        $this->productNumbers = $productNumbers;
        $this->page = $page;
        $this->pageSize = $pageSize;

        parent::__construct(RequestInterface::METHOD_POST, sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/FindProductsByProductNumbers/%s',
            $this->siteId
        ), [
            'Identifiers' => $this->productNumbers,
            'PageIndex' => $this->page,
            'Pagesize' => $this->pageSize
        ]);
    }
}
