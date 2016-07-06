<?php
namespace Dandomain\Api\Endpoint;

use GuzzleHttp\Psr7\Response;

class Settings extends Endpoint {
    /**
     * @return Response
     */
    public function getSites() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/Sites'
        );
    }

    /**
     * @return Response
     */
    public function getCountries() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/Countries'
        );
    }

    /**
     * @return Response
     */
    public function getCurrencies() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/Currencies'
        );
    }

    /**
     * @param int $siteId
     * @return Response
     */
    public function getPaymentMethods($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/PaymentMethods/%d', $siteId)
        );
    }

    /**
     * @param int $siteId
     * @return Response
     */
    public function getShippingMethods($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/ShippingMethods/%d', $siteId)
        );
    }

    /**
     * @param int $siteId
     * @return Response
     */
    public function getCompanyInfo($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf('/admin/WEBAPI/Endpoints/v1_0/SettingService/{KEY}/CompanyInfo/%d', $siteId)
        );
    }
}