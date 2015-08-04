<?php
namespace Dandomain\Api\Endpoint;

class Product extends Endpoint {
    public function getProduct() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getProducts() {
        throw new \RuntimeException('Should be implemented');
    }
    public function getProductsInCategory() {
        throw new \RuntimeException('Should be implemented');
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