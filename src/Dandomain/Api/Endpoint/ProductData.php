<?php
namespace Dandomain\Api\Endpoint;

use GuzzleHttp\Psr7\Response;

class ProductData extends Endpoint {
    /**
     * Returns the product with product number equal to $productNumber
     *
     * @param $productNumber
     * @return Response
     */
    public function getDataProduct($productNumber) {
        $response = $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/' . rawurlencode($productNumber));
        return $response;
    }

    /**
     * Returns the products in the given category
     *
     * @param $categoryId
     * @return Response
     */
    public function getDataProductsInCategory($categoryId) {
        $categoryId = (int)$categoryId;
        $response = $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/Products/{KEY}/' . $categoryId);
        return $response;
    }

    /**
     * Returns products matching the barcode
     *
     * @param $barcode
     * @return Response
     */
    public function getDataProductsByBarcode($barcode) {
        $response = $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ByBarcode/' . rawurlencode($barcode));
        return $response;
    }

    /**
     * Returns products modified on the specified date
     *
     * @param \DateTime $date
     * @return Response
     */
    public function getDataProductsByModificationDate(\DateTime $date) {
        $response = $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ByModificationDate/' . $date->format('Y-m-d'));
        return $response;

    }

    /**
     * Returns the products modified in the given interval
     *
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @return Response
     */
    public function getDataProductsInModifiedInterval(\DateTime $dateStart, \DateTime $dateEnd) {
        $response = $this->getMaster()->call('GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/GetByModifiedInterval?start=' . $dateStart->format('Y-m-d\TH:i:s') . '&end=' . $dateEnd->format('Y-m-d\TH:i:s'));
        return $response;
    }

    /**
     * Creates a product based on the json encoded string $product
     *
     * @param string $product
     * @return Response
     */
    public function createProduct($product) {
        $response = $this->getMaster()->call(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}',
            array('body' => $product)
        );
        return $response;
    }

    /**
     * Sets the stock count on the specified product
     *
     * @param string $productNumber
     * @param int $stockCount
     * @return Response
     */
    public function setStockCount($productNumber, $stockCount) {
        $stockCount = (int)$stockCount;
        $response = $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/SetStockCount/' . rawurlencode($productNumber) . '/' . $stockCount);
        return $response;
    }

    /**
     * Returns the top level categories
     *
     * @return Response
     */
    public function getDataCategories() {
        $response = $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Categories');
        return $response;
    }

    /**
     * Returns the sub categories of the category with id $categoryId
     *
     * @param int $categoryId
     * @return Response
     */
    public function getDataSubCategories($categoryId) {
        $categoryId = (int)$categoryId;
        $response = $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Categories/' . $categoryId);
        return $response;
    }
    public function getProductCount() {
        throw new \RuntimeException('Should be implemented');
    }

    /**
     * @param int $page
     * @param int $pageSize
     * @return Response
     */
    public function getProductPage($page, $pageSize) {
        if(!is_int($page)) {
            throw new \InvalidArgumentException('$page has to be an integer');
        }
        if(!is_int($pageSize)) {
            throw new \InvalidArgumentException('$pageSize has to be an integer');
        }

        $response = $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductPage/' . $page . '/' . $pageSize
        );
        return $response;
    }
    public function deleteProduct() {
        throw new \RuntimeException('Should be implemented');
    }
    public function createCategory() {
        throw new \RuntimeException('Should be implemented');
    }
    public function deleteCategory() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getDataCategory() {
        throw new \RuntimeException('Should be implemented');
    }
    public function updateProduct() {
        throw new \RuntimeException('Should be implemented');
    }
    public function patchProduct() {
        throw new \RuntimeException('Should be implemented');
    }
    public function createPrice() {
        throw new \RuntimeException('Should be implemented');
    }
    public function deletePrice() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getPricesForProduct() {
        throw new \RuntimeException('Should be implemented');
    }
    public function patchProductSettings() {
        throw new \RuntimeException('Should be implemented');
    }

    /**
     * This method will return the number of product pages given a page size of $pageSize
     * If a shop has 10,000 products, a call with $pageSize = 100 will return 10,000 / 100 = 100
     *
     * @param $pageSize
     * @return Response
     */
    public function getProductPageCount($pageSize) {
        $response = $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductPageCount/' . $pageSize);
        return $response;
    }
}