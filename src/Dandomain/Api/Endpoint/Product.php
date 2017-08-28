<?php
namespace Dandomain\Api\Endpoint;

use Assert\Assert;
use Dandomain\Api\Api;
use GuzzleHttp\Psr7\Response;

/**
 * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help Online reference for Product endpoint
 */
class Product extends Endpoint {
    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProduct
     *
     * @param string $productNumber
     * @param int $siteId
     * @return \stdClass
     */
    public function getProduct(string $productNumber, int $siteId) : \stdClass
    {
        Assert::that($siteId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/%s/%d',
                rawurlencode($productNumber),
                $siteId
            )
        ));
    }

    public function getProducts() {
        // @todo implement
        throw new \RuntimeException('Should be implemented');
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductsInCategory
     *
     * @param int $categoryId
     * @param int $siteId
     * @return array
     */
    public function getProductsInCategory(int $categoryId, int $siteId) : array
    {
        Assert::that($categoryId)->greaterThan(0);
        Assert::that($siteId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Products/%d/%d',
                $categoryId,
                $siteId
            )
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetCategories
     *
     * @param int $siteId
     * @return array
     */
    public function getCategories(int $siteId) : array
    {
        Assert::that($siteId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Categories/%d',
                $siteId
            )
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetSubCategories
     *
     * @param int $categoryId
     * @param int $siteId
     * @return Response
     */
    public function getSubCategories(int $categoryId, int $siteId) {
        Assert::that($categoryId)->greaterThan(0);
        Assert::that($siteId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Categories/%d/%d',
                $categoryId,
                $siteId
            )
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductByMetadata
     *
     * @param string $productNumber
     * @param array $context
     * @return \stdClass
     */
    public function getProductByMetadata(string $productNumber, array $context) : \stdClass
    {
        Assert::that($context)->notEmpty();

        return Api::decodeResponse($this->master->request(
            'POST',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/%s',
                rawurlencode($productNumber)
            ),
            [
                'json' => $context
            ]
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductsInCategoryByMetadata
     *
     * @param int $categoryId
     * @param array $context
     * @return array
     */
    public function getProductsInCategoryByMetadata(int $categoryId, array $context) : array
    {
        Assert::that($categoryId)->greaterThan(0);
        Assert::that($context)->notEmpty();

        return Api::decodeResponse($this->master->request(
            'POST',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Products/%d',
                $categoryId
            ),
            [
                'json' => $context
            ]
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetCategory
     *
     * @param int $categoryId
     * @param int $siteId
     * @return \stdClass
     */
    public function getCategory(int $categoryId, int $siteId) : \stdClass
    {
        Assert::that($categoryId)->greaterThan(0);
        Assert::that($siteId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Category/%d/%d',
                $categoryId,
                $siteId
            )
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/FindProductNumbersByKeyword
     *
     * @param string $keyword
     * @param int $siteId
     * @param int $pageSize
     * @param int $page
     * @return array
     */
    public function findProductNumbersByKeyword(string $keyword, int $siteId, int $pageSize = 100, int $page = 1) : array
    {
        Assert::that($siteId)->greaterThan(0);
        Assert::that($pageSize)->greaterThan(0);
        Assert::that($page)->greaterThan(0);

        $query = '';
        if($pageSize) {
            $query = sprintf('?page_size=%d&page=%d', $pageSize, $page);
        }

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/FindProductNumbersByKeyword/%s/%d%s',
                rawurlencode($keyword),
                $siteId,
                $query
            )
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductsByBarcode
     *
     * @param string $barCode
     * @param int $siteId
     * @return array
     */
    public function getProductsByBarcode(string $barCode, int $siteId) : array
    {
        Assert::that($siteId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/ByBarcode/%s/%d',
                rawurlencode($barCode),
                $siteId
            )
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductsByModificationDate
     *
     * @param \DateTimeInterface $modificationDate
     * @param int $siteId
     * @return array
     */
    public function getProductsByModificationDate(\DateTimeInterface $modificationDate, int $siteId) : array
    {
        Assert::that($siteId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/ByModificationDate/%s/%d',
                $modificationDate->format('Y-m-d'),
                $siteId
            )
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/FindProductsByProductNumbers
     *
     * @param int $siteId
     * @param array $productNumbers
     * @return array
     */
    public function findProductsByProductNumbers(int $siteId, array $productNumbers) : array
    {
        Assert::that($siteId)->greaterThan(0);
        Assert::that($productNumbers)->notEmpty();

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/FindProductsByProductNumbers/%d',
                $siteId
            ),
            ['json' => $productNumbers]
        ));
    }

    /**
     * @see http://4221117.shop53.dandomain.dk/admin/webapi/endpoints/v1_0/ProductService/help/operations/GetProductsInModifiedInterval
     *
     * @param int $siteId
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @return array
     */
    public function getProductsInModifiedInterval(int $siteId, \DateTimeInterface $dateStart, \DateTimeInterface $dateEnd) : array
    {
        Assert::that($siteId)->greaterThan(0);

        return Api::decodeResponse($this->master->request(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/GetByModifiedInterval/%d?start=%s&end=%s',
                $siteId,
                $dateStart->format('Y-m-d\TH:i:s'),
                $dateEnd->format('Y-m-d\TH:i:s')
            )
        ));
    }
}