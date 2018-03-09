<?php
namespace Loevgaard\Dandomain\Api\Request\RelatedData;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\PagingTrait;

class GetProductTagPageRequest extends CollectionRequest
{
    use PagingTrait;

    public function __construct(int $page = 1, int $pageSize = 100)
    {
        Assert::that($page)->greaterThan(0, '$page has to be positive');
        Assert::that($pageSize)->greaterThan(0, '$pageSize has to be positive');

        $this->page = $page;
        $this->pageSize = $pageSize;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagPage/%d/%d', $this->page, $this->pageSize));
    }
}
