<?php
namespace Dandomain\Api;

use Dandomain\Api\Endpoint\Customer;
use Dandomain\Api\Endpoint\Order;
use Dandomain\Api\Endpoint\Product;
use Dandomain\Api\Endpoint\ProductData;
use Dandomain\Api\Endpoint\ProductTag;
use Dandomain\Api\Endpoint\RelatedData;
use Dandomain\Api\Endpoint\Settings;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testGetMagicGetters()
    {
        $api = new Api('http://www.example.com', 'api');

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