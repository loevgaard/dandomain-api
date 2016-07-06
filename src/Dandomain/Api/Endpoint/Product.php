<?php
namespace Dandomain\Api\Endpoint;

use GuzzleHttp\Psr7\Response;

class Product extends Endpoint {
    /**
     * @param string $productNumber
     * @param int $siteId
     * @return Response
     */
    public function getProduct($productNumber, $siteId) {
        $this->assertString($productNumber, '$productNumber');
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/%s/%d',
                rawurlencode($productNumber),
                $siteId
            )
        );
    }

    public function getProducts() {
        throw new \RuntimeException('Should be implemented');
    }

    /**
     * @param int $categoryId
     * @param int $siteId
     * @return Response
     */
    public function getProductsInCategory($categoryId, $siteId) {
        $this->assertInteger($categoryId, '$categoryId');
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Products/%d/%d',
                $categoryId,
                $siteId
            )
        );
    }

    /**
     * @param int $siteId
     * @return Response
     */
    public function getCategories($siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Categories/%d',
                $siteId
            )
        );
    }

    /**
     * @param int $categoryId
     * @param int $siteId
     * @return Response
     */
    public function getSubCategories($categoryId, $siteId) {
        $this->assertInteger($categoryId, '$categoryId');
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Categories/%d/%d',
                $categoryId,
                $siteId
            )
        );
    }

    /**
     * @param string $productNumber
     * @param array $context
     * @return Response
     */
    public function getProductByMetadata($productNumber, $context) {
        $this->assertString($productNumber, '$productNumber');
        $this->assertArray($context, '$context');

        return $this->getMaster()->call(
            'POST',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/%s',
                rawurlencode($productNumber)
            ),
            [
                'json' => $context
            ]
        );
    }

    /**
     * @param int $categoryId
     * @param array $context
     * @return Response
     */
    public function getProductsInCategoryByMetadata($categoryId, $context) {
        $this->assertInteger($categoryId, '$categoryId');
        $this->assertArray($context, '$context');

        return $this->getMaster()->call(
            'POST',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Products/%d',
                $categoryId
            ),
            [
                'json' => $context
            ]
        );
    }

    /**
     * @param int $categoryId
     * @param int $siteId
     * @return Response
     */
    public function getCategory($categoryId, $siteId) {
        $this->assertInteger($categoryId, '$categoryId');
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Category/%d/%d',
                $categoryId,
                $siteId
            )
        );
    }

    /**
     * If $pageSize is 0, this method will return ALL matching product numbers
     *
     * @param string $keyword
     * @param int $siteId
     * @param int $pageSize
     * @param int $page
     * @return Response
     */
    public function findProductNumbersByKeyword($keyword, $siteId, $pageSize = 0, $page = 1) {
        $this->assertString($keyword, '$keyword');
        $this->assertInteger($siteId, '$siteId');
        $this->assertInteger($pageSize, '$pageSize');
        $this->assertInteger($page, '$page');
        $this->assertGreaterThanOrEqual(0, $pageSize);
        $this->assertGreaterThanOrEqual(1, $page);

        $query = '';
        if($pageSize) {
            $query = sprintf('?page_size=%d&page=%d', $pageSize, $page);
        }

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/FindProductNumbersByKeyword/%s/%d%s',
                rawurlencode($keyword),
                $siteId,
                $query
            )
        );
    }

    /**
     * @param string $barCode
     * @param int $siteId
     * @return Response
     */
    public function getProductsByBarcode($barCode, $siteId) {
        $this->assertString($barCode, '$barCode');
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/ByBarcode/%s/%d',
                rawurlencode($barCode),
                $siteId
            )
        );
    }

    /**
     * @param \DateTime $modificationDate
     * @param int $siteId
     * @return Response
     */
    public function getProductsByModificationDate(\DateTime $modificationDate, $siteId) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/ByModificationDate/%s/%d',
                $modificationDate->format('Y-m-d'),
                $siteId
            )
        );
    }

    /**
     * @param int $siteId
     * @param array $productNumbers
     * @return Response
     */
    public function findProductsByProductNumbers($siteId, $productNumbers) {
        $this->assertInteger($siteId, '$siteId');
        $this->assertArray($productNumbers, '$productNumbers');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/FindProductsByProductNumbers/%d',
                $siteId
            ),
            ['json' => $productNumbers]
        );
    }

    /**
     * @param int $siteId
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @return Response
     */
    public function getProductsInModifiedInterval($siteId, \DateTime $dateStart, \DateTime $dateEnd) {
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/GetByModifiedInterval/%d?start=%s&end=%s',
                $siteId,
                $dateStart->format('Y-m-d\TH:i:s'),
                $dateEnd->format('Y-m-d\TH:i:s')
            )
        );
    }
}