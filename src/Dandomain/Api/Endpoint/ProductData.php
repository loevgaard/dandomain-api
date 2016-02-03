<?php
namespace Dandomain\Api\Endpoint;

use Dandomain\Api\JsonStreamingParser\Listener\ObjectListener;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\StreamWrapper;

class ProductData extends Endpoint {
    /**
     * Returns the product with product number equal to $productNumber
     *
     * @param $productNumber
     * @return Response
     */
    public function getDataProduct($productNumber) {
        return $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/' . rawurlencode($productNumber));
    }

    /**
     * Returns the products in the given category
     *
     * @param int $categoryId
     * @return Response
     */
    public function getDataProductsInCategory($categoryId) {
        $this->assertInteger($categoryId, '$categoryId');
        return $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/Products/{KEY}/' . $categoryId);
    }

    /**
     * Returns products matching the barcode
     *
     * @param string $barcode
     * @return Response
     */
    public function getDataProductsByBarcode($barcode) {
        return $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ByBarcode/' . rawurlencode($barcode));
    }

    /**
     * Returns products modified on the specified date
     *
     * @param \DateTime $date
     * @return Response
     */
    public function getDataProductsByModificationDate(\DateTime $date) {
        return $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ByModificationDate/' . $date->format('Y-m-d'));

    }

    /**
     * Returns the products modified in the given interval
     *
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @return Response
     */
    public function getDataProductsInModifiedInterval(\DateTime $dateStart, \DateTime $dateEnd) {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/GetByModifiedInterval?start=' . $dateStart->format('Y-m-d\TH:i:s') . '&end=' . $dateEnd->format('Y-m-d\TH:i:s'));
    }

    /**
     * Creates a product based on the json encoded string $product
     *
     * @param string $product
     * @return Response
     */
    public function createProduct($product) {
        return $this->getMaster()->call(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}',
            array('body' => $product)
        );
    }

    /**
     * Sets the stock count on the specified product
     *
     * @param string $productNumber
     * @param int $stockCount
     * @return Response
     */
    public function setStockCount($productNumber, $stockCount) {
        $this->assertString($productNumber, '$stockCount');
        $this->assertInteger($stockCount, '$stockCount');

        $stockCount = (int)$stockCount;
        return $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/SetStockCount/' . rawurlencode($productNumber) . '/' . $stockCount);
    }

    /**
     * Returns the top level categories
     *
     * @return Response
     */
    public function getDataCategories() {
        return $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Categories');
    }

    /**
     * Returns the sub categories of the category with id $categoryId
     *
     * @param int $categoryId
     * @return Response
     */
    public function getDataSubCategories($categoryId) {
        $this->assertInteger($categoryId, '$categoryId');

        return $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Categories/' . $categoryId);
    }

    public function getProductCount() {
        return $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductCount');
    }

    /**
     * The getProductPage method retrieves a paged list of products
     *
     * @param int $page
     * @param int $pageSize
     * @return Response
     */
    public function getProductPage($page, $pageSize) {
        $this->assertInteger($page, '$page');
        $this->assertInteger($pageSize, '$pageSize');

        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductPage/' . $page . '/' . $pageSize
        );
    }

    /**
     * TEST TEST TEST
     * This method will try to return entities instead of a response
     * @TODO Use XML instead
     * @TODO Maybe use this https://github.com/prewk/xml-string-streamer-guzzle
     * @TODO Or this http://dk2.php.net/manual/en/function.xml-parse.php
     *
     * @param int $page
     * @param int $pageSize
     * @return Response
     */
    public function getProductPageAsEntities($page, $pageSize) {
        $response = $this->getProductPage($page, $pageSize);
        $resource = StreamWrapper::getResource($response->getBody());

        $listener = new ObjectListener(function($obj) {
            echo "DUMPING\n\n";
            print_r($obj);
            echo "\n\n";
        }, function() {
            echo "END CALLBACK\n";
        });
        $parser = new \JsonStreamingParser_Parser($resource, $listener);
        $parser->parse();
    }

    /**
     * This method will return the number of product pages given a page size of $pageSize
     * If a shop has 10,000 products, a call with $pageSize = 100 will return 10,000 / 100 = 100
     *
     * @param $pageSize
     * @return Response
     */
    public function getProductPageCount($pageSize) {
        return $this->getMaster()->call('GET', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductPageCount/' . $pageSize);
    }

    /**
     * Deletes a product with the given $productNumber
     *
     * @param string $productNumber
     * @return Response
     */
    public function deleteProduct($productNumber) {
        $this->assertString($productNumber, '$productNumber');

        return $this->getMaster()->call('DELETE', '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/' . rawurlencode($productNumber));
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
}