<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\Assert;
use function Loevgaard\Dandomain\Api\objectToArray;

class ProductData extends Endpoint
{
    /**
     * @param string $productNumber
     * @return array
     */
    public function getDataProduct(string $productNumber) : array
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s',
                rawurlencode($productNumber)
            )
        );
    }

    /**
     * @param int $categoryId
     * @return array
     */
    public function getDataProductsInCategory($categoryId) : array
    {
        Assert::that($categoryId)->greaterThan(0, 'The $categoryId has to be positive');

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/Products/{KEY}/%d',
                $categoryId
            )
        );
    }

    /**
     * @param string $barCode
     * @return array
     */
    public function getDataProductsByBarcode($barCode) : array
    {
        Assert::that($barCode)->minLength(1, 'The length of $barCode has to be > 0');

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ByBarcode/%s',
                rawurlencode($barCode)
            )
        );
    }

    /**
     * @param \DateTimeInterface $date
     * @return array
     */
    public function getDataProductsByModificationDate(\DateTimeInterface $date) : array
    {
        return $this->master->doRequest(
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
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getDataProductsInModifiedInterval(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd, $page = 1, $pageSize = 100) : array
    {
        Assert::that($dateStart)->lessThan($dateEnd, '$dateStart has to be before $dateEnd');
        Assert::that($page)->greaterThan(0, 'The $page has to be positive');
        Assert::that($pageSize)->greaterThan(0, 'The $pageSize has to be positive');

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/GetByModifiedInterval?start=%s&end=%s&pageIndex=%d&pageSize=%d',
                $dateStart->format('Y-m-d\TH:i:s'),
                $dateEnd->format('Y-m-d\TH:i:s'),
                $page,
                $pageSize
            )
        );
    }

    /**
     * @param \DateTimeInterface $dateStart
     * @param \DateTimeInterface $dateEnd
     * @return int
     */
    public function countByModifiedInterval(\DateTimeInterface $dateStart, \DateTimeInterface $dateEnd) : int
    {
        return (int)$this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/CountByModifiedInterval?start=%s&end=%s',
                $dateStart->format('Y-m-d\TH:i:s'),
                $dateEnd->format('Y-m-d\TH:i:s')
            )
        );
    }

    /**
     * @param array|\stdClass $product
     * @return array
     */
    public function createProduct($product) : array
    {
        $product = objectToArray($product);

        return $this->master->doRequest(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}',
            ['json' => $product]
        );
    }

    /**
     * @param string $productNumber
     * @param int $stockCount
     * @return bool
     */
    public function setStockCount(string $productNumber, int $stockCount) : bool
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');

        return $this->master->doRequest(
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
    public function getStockCount(string $productNumber) : int
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');
        $product = $this->getDataProduct($productNumber);

        return (int)$product['stockCount'];
    }

    /**
     * Will increment or decrement the stock count for the given product number
     *
     * @param string $productNumber
     * @param int $amount
     * @return array
     */
    public function incrementOrDecrementStockCount(string $productNumber, int $amount)
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');

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
    public function incrementStockCount(string $productNumber, int $amount)
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');

        return $this->incrementOrDecrementStockCount($productNumber, abs($amount));
    }

    /**
     * Will decrement the stock count for the given product number
     *
     * @param string $productNumber
     * @param int $amount
     * @return array
     */
    public function decrementStockCount(string $productNumber, int $amount)
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');

        return $this->incrementOrDecrementStockCount($productNumber, abs($amount));
    }

    /**
     * @return array
     */
    public function getDataCategories() : array
    {
        return $this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Categories'
        );
    }

    /**
     * @param int $categoryId
     * @return array
     */
    public function getDataSubCategories(int $categoryId) : array
    {
        Assert::that($categoryId)->greaterThan(0, 'The $categoryId has to be positive');

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Categories/%d',
                $categoryId
            )
        );
    }

    /**
     * @return int
     */
    public function getProductCount() : int
    {
        return (int)$this->master->doRequest(
            'GET',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductCount'
        );
    }

    /**
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public function getProductPage(int $page = 1, int $pageSize = 100) : array
    {
        Assert::that($page)->greaterThan(0, 'The $page has to be positive');
        Assert::that($pageSize)->greaterThan(0, 'The $pageSize has to be positive');

        return $this->master->doRequest(
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
     * @return int
     */
    public function getProductPageCount($pageSize = 100) : int
    {
        Assert::that($pageSize)->greaterThan(0, 'The $pageSize has to be positive');

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/ProductPageCount/%d',
                $pageSize
            )
        );
    }

    /**
     * @param string $productNumber
     * @return boolean
     */
    public function deleteProduct(string $productNumber) : bool
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');

        return $this->master->doRequest(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s',
                rawurlencode($productNumber)
            )
        );
    }

    /**
     * @param array $category
     * @return array
     */
    public function createCategory($category) : array
    {
        $category = objectToArray($category);
        Assert::that($category)->notEmpty('$category must not be empty');

        return $this->master->doRequest(
            'POST',
            '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Category',
            ['json' => $category]
        );
    }

    /**
     * @param $categoryId
     * @return boolean
     */
    public function deleteCategory($categoryId) : bool
    {
        Assert::that($categoryId)->greaterThan(0, 'The $pageSize has to be positive');

        return $this->master->doRequest(
            'DELETE',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/Category/%d',
                $categoryId
            )
        );
    }

    /**
     * @param int $categoryId
     * @return array
     */
    public function getDataCategory(int $categoryId) : array
    {
        Assert::that($categoryId)->greaterThan(0, 'The $pageSize has to be positive');

        return $this->master->doRequest(
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
     * @return array
     */
    public function updateProduct($productNumber, $product) : array
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');
        $product = objectToArray($product);
        Assert::that($product)->notEmpty('$product must not be empty');

        return $this->master->doRequest(
            'PUT',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s',
                rawurlencode($productNumber)
            ),
            ['json' => $product]
        );
    }

    /**
     * Use a key value structure to patch a product, i.e.
     *
     * $data = [
     *   'keyValues' => [
     *     ['Key' => 'property', 'Value' => 'new value of property']
     *   ]
     * ]
     *
     * @param string $productNumber
     * @param array $data
     * @return array
     */
    public function patchProduct(string $productNumber, array $data) : array
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');
        Assert::that($data)->keyExists('keyValues');
        Assert::that($data['keyValues'])->isArray()->notEmpty();

        return $this->master->doRequest(
            'PATCH',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s',
                rawurlencode($productNumber)
            ),
            ['json' => $data]
        );
    }

    /**
     * @param string $productNumber
     * @param array $price
     * @return array
     */
    public function createPrice(string $productNumber, $price)
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');
        $price = objectToArray($price);
        Assert::that($price)->notEmpty('$price must not be empty');

        return $this->master->doRequest(
            'POST',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s/Prices',
                rawurlencode($productNumber)
            ),
            ['json' => $price]
        );
    }

    /**
     * @param string $productNumber
     * @param array $price
     * @return bool
     */
    public function deletePrice($productNumber, $price) : bool
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');
        $price = objectToArray($price);
        Assert::that($price)->notEmpty('$price must not be empty');

        return $this->master->doRequest(
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
     * @return array
     */
    public function getPricesForProduct($productNumber) : array
    {
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');

        return $this->master->doRequest(
            'GET',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%s/Prices/List',
                rawurlencode($productNumber)
            )
        );
    }

    /**
     * Use a key value structure to patch product settings, i.e.
     *
     * $data = [
     *   'keyValues' => [
     *     ['Key' => 'property', 'Value' => 'new value of property']
     *   ]
     * ]
     *
     * @param int $siteId
     * @param string $productNumber
     * @param array $data
     * @return array
     */
    public function patchProductSettings(int $siteId, string $productNumber, array $data) : array
    {
        Assert::that($siteId)->greaterThan(0, 'The $siteId has to be positive');
        Assert::that($productNumber)->minLength(1, 'The length of $productNumber has to be > 0');
        Assert::that($data)->keyExists('keyValues');
        Assert::that($data['keyValues'])->isArray()->notEmpty();

        return $this->master->doRequest(
            'PATCH',
            sprintf(
                '/admin/WEBAPI/Endpoints/v1_0/ProductDataService/{KEY}/%d/Products/%s/Settings',
                $siteId,
                rawurlencode($productNumber)
            ),
            ['json' => $data]
        );
    }
}
