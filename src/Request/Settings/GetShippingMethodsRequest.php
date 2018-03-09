<?php
namespace Loevgaard\Dandomain\Api\Request\Settings;

use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Loevgaard\Dandomain\Api\Traits\SiteIdTrait;
use Loevgaard\Dandomain\Api\ValueObject\SiteId;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/SettingService/help/operations/GetShippingMethods
 */
class GetShippingMethodsRequest extends CollectionRequest
{
    use SiteIdTrait;

    public function __construct(SiteId $siteId)
    {
        $this->siteId = $siteId;

        parent::__construct(RequestInterface::METHOD_GET, sprintf('/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/ShippingMethods/%s', $this->siteId));
    }
}
