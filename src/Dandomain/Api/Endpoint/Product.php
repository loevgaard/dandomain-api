<?php
namespace Dandomain\Api\Endpoint;

class Product extends Endpoint {
    public function getProduct() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getProducts() {
        throw new \RuntimeException('Should be implemented');
    }

    /**
     * This method will return products in the given category and site
     *
     * @param int $categoryId
     * @param int $siteId
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getProductsInCategory($categoryId, $siteId) {
        $this->assertInteger($categoryId, '$categoryId');
        $this->assertInteger($siteId, '$siteId');

        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductService/{KEY}/Products/' . $categoryId . '/' . $siteId
        );
    }
    public function getCategories() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getSubCategories() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getProductByMetadata() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getProductsInCategoryByMetadata() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getCategory() {
        throw new \RuntimeException('Should be implemented');
    }
    public function findProductNumbersByKeyword() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getProductsByBarcode() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getProductsByModificationDate() {
        throw new \RuntimeException('Should be implemented');
    }
    public function findProductsByProductNumbers() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getProductsInModifiedInterval() {
        throw new \RuntimeException('Should be implemented');
    }
}