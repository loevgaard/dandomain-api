<?php
namespace Loevgaard\Dandomain\Api\Endpoint;
    
use Assert\Assert;
    
/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/Endpoints/v1_0/PluginService.svc
 */
class Plugin extends Endpoint
{
    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/app-developer/
     *
     * @param int $appId
     * @return array
     */
    public function getSiteInfo(int $appId) : array
    {
        Assert::that($appId)->greaterThan(0, 'The $appId has to be positive');
        return (array)$this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/PluginService/{KEY}/SiteInfo/%s',
                $appId
            )
        );
    }
    
    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/app-developer/
     *
     * @param int $appId
     * @param array\stdClass $body
     * @return array
     */
    public function updateAppScripts(int $appId, $body) : array
    {
        Assert::that($appId)->greaterThan(0, 'The $appId has to be positive');
        return (array)$this->master->doRequest(
            'POST',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/PluginService/{KEY}/%s/SetAppScript',
                $appId
            ),
            $body
        );
    }

    /**
     * @see https://shoppartner.dandomain.dk/dokumentation/app-developer/
     *
     * @param int $appId
     * @param int $pageType
     * @return boolean
     */
    public function deleteAppScripts(int $appId, int $pageType) : bool
    {
        Assert::that($appId)->greaterThan(0, 'The $appId has to be positive');
        return (bool)$this->master->doRequest(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/PluginService/{KEY}/DeleteAppScriptForPage?appId=%s&pageType=%s',
                $appId,
                $pageType
            )
        );
    }
}
