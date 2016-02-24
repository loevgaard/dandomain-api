<?php
namespace Dandomain\Api\Endpoint;

class RelatedData extends Endpoint {
    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getManufacturers() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Manufacturers'
        );
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getPeriods() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Periods'
        );
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getProductTypes() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/ProductTypes'
        );
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getSegments() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Segments'
        );
    }

    /**
     * @param int $siteId
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getSegmentsForSite($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Segments/' . $siteId
        );
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getUnits() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Units'
        );
    }

    /**
     * @param int $siteId
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getUnitsForSite($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Units/' . $siteId
        );
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getVariantGroups() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/VariantGroups'
        );
    }

    /**
     * @param int $siteId
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getVariantGroupsForSite($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/VariantGroups/' . $siteId
        );
    }
}