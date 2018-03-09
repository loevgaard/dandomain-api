<?php
namespace Loevgaard\Dandomain\Api\Request\Product;

use Assert\Assert;
use Loevgaard\Dandomain\Api\DateTime\DateInterval;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\DateIntervalTrait;
use Loevgaard\Dandomain\Api\Traits\PagingTrait;
use Loevgaard\Dandomain\Api\Traits\SiteIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\SiteId;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductsInModifiedInterval
 */
class GetProductsInModifiedIntervalRequest extends CollectionRequest
{
    use SiteIdTrait;
    use DateIntervalTrait;
    use PagingTrait;

    public function __construct(SiteId $siteId, DateInterval $dateInterval, int $page = 1, int $pageSize = 100)
    {
        Assert::that($page)->greaterThan(0, 'The page has to be positive');
        Assert::that($pageSize)->greaterThan(0, 'The page size has to be positive');

        $this->siteId = $siteId;
        $this->dateInterval = $dateInterval;
        $this->page = $page;
        $this->pageSize = $pageSize;

        parent::__construct(RequestInterface::METHOD_GET, sprintf(
            '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/GetByModifiedInterval/%s?start=%s&end=%s&pageIndex=%d&pageSize=%d',
            $this->siteId,
            $this->dateInterval->getStart()->format('Y-m-d\TH:i:s'),
            $this->dateInterval->getEnd()->format('Y-m-d\TH:i:s'),
            $this->page,
            $this->pageSize
        ));
    }
}
