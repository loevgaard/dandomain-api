<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/RelatedDataService/help
 */
class RelatedData extends Endpoint
{
    /**
     * @return array
     */
    public function getManufacturers() : array
    {
        return (array)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Manufacturers'
        );
    }

    /**
     * @return array
     */
    public function getPeriods() : array
    {
        return (array)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Periods'
        );
    }

    /**
     * @return array
     */
    public function getProductTypes() : array
    {
        return (array)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/ProductTypes'
        );
    }

    /**
     * @return array
     */
    public function getSegments() : array
    {
        return (array)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Segments'
        );
    }

    /**
     * @param int $siteId
     * @return array
     */
    public function getSegmentsForSite($siteId) : array
    {
        Assert::that($siteId)->greaterThan(0, 'The $siteId has to be positive');

        return (array)$this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Segments/%d',
                $siteId
            )
        );
    }

    /**
     * @return array
     */
    public function getUnits() : array
    {
        return (array)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Units'
        );
    }

    /**
     * @param int $siteId
     * @return array
     */
    public function getUnitsForSite($siteId) : array
    {
        Assert::that($siteId)->greaterThan(0, 'The $siteId has to be positive');

        return (array)$this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/Units/%d',
                $siteId
            )
        );
    }

    /**
     * @return array
     */
    public function getVariantGroups() : array
    {
        return (array)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/VariantGroups'
        );
    }

    /**
     * @param int $siteId
     * @return array
     */
    public function getVariantGroupsForSite($siteId) : array
    {
        Assert::that($siteId)->greaterThan(0, 'The $siteId has to be positive');

        return (array)$this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/RelatedDataService/{KEY}/VariantGroups/%d',
                $siteId
            )
        );
    }
}
