<?php
namespace Loevgaard\Dandomain\Api\Request\RelatedData;

use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\SiteIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\SiteId;

class GetUnitsForSiteRequest extends CollectionRequest
{
    use SiteIdTrait;

    public function __construct(SiteId $siteId)
    {
        $this->siteId = $siteId;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Units/%s', $this->siteId));
    }
}
