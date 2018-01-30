<?php
namespace Loevgaard\Dandomain\Api;

use Loevgaard\Dandomain\Api\Endpoint\Customer;
use Loevgaard\Dandomain\Api\Endpoint\Order;
use Loevgaard\Dandomain\Api\Endpoint\Product;
use Loevgaard\Dandomain\Api\Endpoint\ProductData;
use Loevgaard\Dandomain\Api\Endpoint\ProductTag;
use Loevgaard\Dandomain\Api\Endpoint\RelatedData;
use Loevgaard\Dandomain\Api\Endpoint\Settings;
use PHPUnit\Framework\TestCase;

final class ApiTest extends TestCase
{
    public function testGetMagicGetters()
    {
        $api = new Api('http://www.example.com', 'apikeyapikeyapikeyapikeyapikeyapikey');

        $endpoint = $api->customer;
        $this->assertInstanceOf(Customer::class, $endpoint);

        $endpoint = $api->order;
        $this->assertInstanceOf(Order::class, $endpoint);

        $endpoint = $api->product;
        $this->assertInstanceOf(Product::class, $endpoint);

        $endpoint = $api->productData;
        $this->assertInstanceOf(ProductData::class, $endpoint);

        $endpoint = $api->productTag;
        $this->assertInstanceOf(ProductTag::class, $endpoint);

        $endpoint = $api->relatedData;
        $this->assertInstanceOf(RelatedData::class, $endpoint);

        $endpoint = $api->settings;
        $this->assertInstanceOf(Settings::class, $endpoint);
    }
}
