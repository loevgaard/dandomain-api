<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/SettingService/help
 */
class Settings extends Endpoint
{
    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/SettingService/help/operations/GetSites
     *
     * @return array
     */
    public function getSites() : array
    {
        return (array)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/Sites'
        );
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/SettingService/help/operations/GetCountries
     *
     * @return array
     */
    public function getCountries() : array
    {
        return (array)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/Countries'
        );
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/SettingService/help/operations/GetCurrencies
     *
     * @return array
     */
    public function getCurrencies() : array
    {
        return (array)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/Currencies'
        );
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/SettingService/help/operations/GetPaymentMethods
     *
     * @param int $siteId
     * @return array
     */
    public function getPaymentMethods(int $siteId) : array
    {
        Assert::that($siteId)->greaterThan(0, 'The $siteId has to be positive');

        return (array)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/PaymentMethods/%d', $siteId)
        );
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/SettingService/help/operations/GetShippingMethods
     *
     * @param int $siteId
     * @return array
     */
    public function getShippingMethods(int $siteId) : array
    {
        Assert::that($siteId)->greaterThan(0, 'The $siteId has to be positive');

        return (array)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/ShippingMethods/%d', $siteId)
        );
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/SettingService/help/operations/GetCompanyInfo
     *
     * @param int $siteId
     * @return array
     */
    public function getCompanyInfo(int $siteId) : array
    {
        Assert::that($siteId)->greaterThan(0, 'The $siteId has to be positive');

        return (array)$this->master->doRequest(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/CompanyInfo/%d', $siteId)
        );
    }
}
