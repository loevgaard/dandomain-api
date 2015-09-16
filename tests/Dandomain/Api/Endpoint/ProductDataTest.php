<?php
namespace Dandomain\Tests\Endpoint;

use Dandomain\Api\Api;
use GuzzleHttp\Psr7\Response;

class ProductDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Api
     */
    protected $api;

    protected function setUp()
    {
        $this->api = new Api($GLOBALS['host'], $GLOBALS['apiKey']);
    }

    public function testGetProductPageCount()
    {
        $response = $this->api->productData->getProductPageCount(100);
        $this->assertHttpOk($response);

        $pages = (int)$response->getBody()->getContents();
        $this->assertGreaterThan(0, $pages);
    }

    public function testGetDataProductsInModifiedInterval() {
        $dateStart  = new \DateTime();
        $dateStart->sub(new \DateInterval($GLOBALS['productModificationInterval']));
        $dateEnd    = new \DateTime();

        $response = $this->api->productData->getDataProductsInModifiedInterval($dateStart, $dateEnd);
        $this->assertHttpOk($response);

        $products = json_decode($response->getBody()->getContents(), true);

        $this->assertTrue(is_array($products));
    }

    /**
     * Helper method
     *
     * @param Response $response
     */
    public function assertHttpOk(Response $response) {
        $this->assertEquals(200, $response->getStatusCode());
    }
}