<?php
namespace Loevgaard\Dandomain\Api\Request\RelatedData;

use Assert\Assert;
use Loevgaard\Dandomain\Api\Request\IntRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\PageSizeTrait;

class GetProductTagPageCountRequest extends IntRequest
{
    use PageSizeTrait;

    public function __construct(int $pageSize = 100)
    {
        Assert::that($pageSize)->greaterThan(0, 'Page size must be positive');

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/ProductTagService/{KEY}/ProductTagPageCount/%d', $this->pageSize));
    }
}
