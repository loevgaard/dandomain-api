<?php
namespace Dandomain\Api\Endpoint;

use GuzzleHttp\Psr7\Response;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;
use Dandomain\Api\Entity;

class ProductData extends Endpoint {
    /**
     * @param string $productNumber
     * @return Response
     */
    public function getDataProduct($productNumber) {
        $this->assertString($productNumber, '$productNumber');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s',
                rawurlencode($productNumber)
            )
        );
    }

    /**
     * @param int $categoryId
     * @return Response
     */
    public function getDataProductsInCategory($categoryId) {
        $this->assertInteger($categoryId, '$categoryId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/Products/{KEY}/%d',
                $categoryId
            )
        );
    }

    /**
     * @param string $barCode
     * @return Response
     */
    public function getDataProductsByBarcode($barCode) {
        $this->assertString($barCode, '$barCode');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ByBarcode/%s',
                rawurlencode($barCode)
            )
        );
    }

    /**
     * @param \DateTimeInterface $date
     * @return Response
     */
    public function getDataProductsByModificationDate(\DateTimeInterface $date) {
        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ByModificationDate/%s',
                $date->format('Y-m-d')
            )
        );
    }

    /**
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @return Response
     */
    public function getDataProductsInModifiedInterval(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd) {
        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/GetByModifiedInterval?start=%s&end=%s',
                $dateStart->format('Y-m-d\TH:i:s'),
                $dateEnd->format('Y-m-d\TH:i:s')
            )
        );
    }

    /**
     * @param array $product
     * @return Response
     */
    public function createProduct($product) {
        $this->assertArray($product, '$product');

        return $this->getMaster()->call(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}',
            ['json' => $product]
        );
    }

    /**
     * @param string $productNumber
     * @param int $stockCount
     * @return Response
     */
    public function setStockCount($productNumber, $stockCount) {
        $this->assertString($productNumber, '$productNumber');
        $this->assertInteger($stockCount, '$stockCount');

        return $this->getMaster()->call(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/SetStockCount/%s/%d',
                rawurlencode($productNumber),
                $stockCount
            )
        );
    }

    /**
     * Will return the stock count for the specified product number
     *
     * @param string $productNumber
     * @return int
     */
    public function getStockCount($productNumber) {
        $product = \GuzzleHttp\json_decode($this->getDataProduct($productNumber)->getBody()->getContents());
        return (int)$product->stockCount;
    }

    /**
     * Will increment or decrement the stock count for the given product number
     *
     * @param string $productNumber
     * @param int $amount
     * @return array
     */
    public function incrementOrDecrementStockCount($productNumber, $amount) {
        $this->assertInteger($amount, '$amount');

        $oldStockCount = $this->getStockCount($productNumber);
        $newStockCount = $oldStockCount + $amount;

        $this->setStockCount($productNumber, $newStockCount);

        return [
            'oldStockCount' => $oldStockCount,
            'newStockCount' => $newStockCount,
        ];
    }

    /**
     * Will increment the stock count for the given product number
     *
     * @param string $productNumber
     * @param int $amount
     * @return array
     */
    public function incrementStockCount($productNumber, $amount) {
        $this->assertInteger($amount, '$amount');
        $this->assertGreaterThan(0, $amount, '$amount');
        return $this->incrementOrDecrementStockCount($productNumber, $amount);
    }

    /**
     * Will decrement the stock count for the given product number
     *
     * @param string $productNumber
     * @param int $amount
     * @return array
     */
    public function decrementStockCount($productNumber, $amount) {
        $this->assertInteger($amount, '$amount');
        $this->assertLessThan(0, $amount, '$amount');
        return $this->incrementOrDecrementStockCount($productNumber, $amount);
    }

    /**
     * @return Response
     */
    public function getDataCategories() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Categories'
        );
    }

    /**
     * @param int $categoryId
     * @return Response
     */
    public function getDataSubCategories($categoryId) {
        $this->assertInteger($categoryId, '$categoryId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Categories/%d',
                $categoryId
            )
        );
    }

    public function getProductCount() {
        return $this->getMaster()->call(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductCount'
        );
    }

    /**
     * @param int $page
     * @param int $pageSize
     * @return Response
     */
    public function getProductPage($page, $pageSize) {
        $this->assertInteger($page, '$page');
        $this->assertInteger($pageSize, '$pageSize');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductPage/%d/%d',
                $page,
                $pageSize
            )
        );
    }

    /**
     * This method will return the number of pages you need to iterate to get the whole catalog using a page size of $pageSize
     * If a shop has 10,000 products, a call with $pageSize = 100 will return 10,000 / 100 = 100
     *
     * @param int $pageSize
     * @return Response
     */
    public function getProductPageCount($pageSize) {
        $this->assertInteger($pageSize, '$pageSize');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductPageCount/%d',
                $pageSize
            )
        );
    }

    /**
     * @param string $productNumber
     * @return Response
     */
    public function deleteProduct($productNumber) {
        $this->assertString($productNumber, '$productNumber');

        return $this->getMaster()->call(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s',
                rawurlencode($productNumber)
            )
        );
    }

    /**
     * @param array $category
     * @return Response
     */
    public function createCategory($category) {
        $this->assertArray($category, '$category');

        return $this->getMaster()->call(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Category',
            ['json' => $category]
        );
    }

    /**
     * @param $categoryId
     * @return Response
     */
    public function deleteCategory($categoryId) {
        $this->assertInteger($categoryId, '$categoryId');

        return $this->getMaster()->call(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Category/%d',
                $categoryId
            )
        );
    }

    /**
     * @param int $categoryId
     * @return Response
     */
    public function getDataCategory($categoryId) {
        $this->assertInteger($categoryId, '$categoryId');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Category/%d',
                $categoryId
            )
        );
    }

    /**
     * @param string $productNumber
     * @param array $product
     * @return Response
     */
    public function updateProduct($productNumber, $product) {
        $this->assertString($productNumber, '$productNumber');
        $this->assertArray($product, '$product');

        return $this->getMaster()->call(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/{ID}',
                rawurlencode($productNumber)
            ),
            ['json' => $product]
        );
    }

    /**
     * @param string $productNumber
     * @param array $product
     * @return Response
     */
    public function patchProduct($productNumber, $product) {
        $this->assertString($productNumber, '$productNumber');
        $this->assertArray($product, '$product');

        return $this->getMaster()->call(
            'PATCH',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/{PRODUCTNUMBER}',
                rawurlencode($productNumber)
            ),
            ['json' => $product]
        );
    }

    /**
     * @param string $productNumber
     * @param array $price
     * @return Response
     */
    public function createPrice($productNumber, $price) {
        $this->assertString($productNumber, '$productNumber');
        $this->assertArray($price, '$price');

        return $this->getMaster()->call(
            'POST',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/{PRODUCTNUMBER}/Prices',
                rawurlencode($productNumber)
            ),
            ['json' => $price]
        );
    }

    /**
     * @param string $productNumber
     * @param array $price
     * @return Response
     */
    public function deletePrice($productNumber, $price) {
        $this->assertString($productNumber, '$productNumber');
        $this->assertArray($price, '$price');

        return $this->getMaster()->call(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s/Prices',
                rawurlencode($productNumber)
            ),
            ['json' => $price]
        );
    }

    /**
     * @param string $productNumber
     * @return Response
     */
    public function getPricesForProduct($productNumber) {
        $this->assertString($productNumber, '$productNumber');

        return $this->getMaster()->call(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s/Prices/List',
                rawurlencode($productNumber)
            )
        );
    }

    /**
     * @param int $siteId
     * @param string $productNumber
     * @param array $settings
     * @return Response
     */
    public function patchProductSettings($siteId, $productNumber, $settings) {
        $this->assertInteger($siteId, '$siteId');
        $this->assertString($productNumber, '$productNumber');
        $this->assertArray($settings, '$settings');

        return $this->getMaster()->call(
            'PATCH',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%d/Products/%s/Settings',
                $siteId,
                rawurlencode($productNumber)
            ),
            ['json' => $settings]
        );
    }

    /**
     * ENTITY METHODS
     */
    /**
     * TEST TEST TEST
     * This method will try to return entities instead of a response
     * @TODO Use XML instead
     * @TODO Maybe use this https://github.com/prewk/xml-string-streamer-guzzle
     * @TODO Or this http://dk2.php.net/manual/en/function.xml-parse.php
     * @TODO Maybe create my own parser: http://php.net/manual/en/example.xml-structure.php
     *
     * @param int $page
     * @param int $pageSize
     * @return Response
     */
    public function getProductPageAsEntities($page, $pageSize) {
        $response = $this->getProductPage($page, $pageSize);
        $stream = new Stream\Guzzle('');
        $stream->setGuzzleStream($response->getBody());
        $parser = new Parser\StringWalker();

        $streamer = new XmlStringStreamer($parser, $stream);

        while ($node = $streamer->getNode()) {
            $xml = new \SimpleXMLElement($node, LIBXML_NOERROR);
            //$entity = new Entity\ProductData();

            yield $xml;
        }
    }
}