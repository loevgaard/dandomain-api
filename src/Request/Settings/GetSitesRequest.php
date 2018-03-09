<?php
namespace Loevgaard\Dandomain\Api\Request\Settings;

use Loevgaard\Dandomain\Api\Request\CollectionRequest;
use Loevgaard\Dandomain\Api\Request\RequestInterface;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/SettingService/help/operations/GetSites
 */
class GetSitesRequest extends CollectionRequest
{
    public function __construct()
    {
        parent::__construct(RequestInterface::METHOD_GET, '/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/Sites');
    }
}
