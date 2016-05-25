<?php
namespace Dandomain\Api\Endpoint;

use GuzzleHttp\Psr7\Response;

class RelatedData extends Endpoint {
    /**
     * @return Response
     */
    public function getManufacturers() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Manufacturers'
        );
    }

    /**
     * @return Response
     */
    public function getPeriods() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Periods'
        );
    }

    /**
     * @return Response
     */
    public function getProductTypes() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/ProductTypes'
        );
    }

    /**
     * @return Response
     */
    public function getSegments() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Segments'
        );
    }

    /**
     * @param int $siteId
     * @return Response
     */
    public function getSegmentsForSite($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Segments/%d',
                $siteId
            )
        );
    }

    /**
     * @return Response
     */
    public function getUnits() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Units'
        );
    }

    /**
     * @param int $siteId
     * @return Response
     */
    public function getUnitsForSite($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Units/%d',
                $siteId
            )
        );
    }

    /**
     * @return Response
     */
    public function getVariantGroups() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/VariantGroups'
        );
    }

    /**
     * @param int $siteId
     * @return Response
     */
    public function getVariantGroupsForSite($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/VariantGroups/%d',
                $siteId
            )
        );
    }
}