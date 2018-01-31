<?php
namespace Loevgaard\Dandomain\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Loevgaard\Dandomain\Api\Endpoint\Customer;
use Loevgaard\Dandomain\Api\Endpoint\Discount;
use Loevgaard\Dandomain\Api\Endpoint\Order;
use Loevgaard\Dandomain\Api\Endpoint\Product;
use Loevgaard\Dandomain\Api\Endpoint\ProductData;
use Loevgaard\Dandomain\Api\Endpoint\ProductTag;
use Loevgaard\Dandomain\Api\Endpoint\RelatedData;
use Loevgaard\Dandomain\Api\Endpoint\Settings;

final class ApiTest extends TestCase
{
    public function testGetMagicGetters()
    {
        $api = new Api('http://www.example.com', 'apikeyapikeyapikeyapikeyapikeyapikey');

        $endpoint = $api->customer;
        $this->assertInstanceOf(Customer::class, $endpoint);

        $endpoint = $api->discount;
        $this->assertInstanceOf(Discount::class, $endpoint);

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

    public function testResolveOptions()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'name' => 'name'
            ])),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = $this->getApi($client);
        $api->setDefaultOptions([
            'requestOptions' => [
                RequestOptions::TIMEOUT => 600,
            ]
        ]);
        $api->customer->getCustomer(1);

        // test the option we changed
        $this->assertSame(600, $api->getLastOptions()['requestOptions'][RequestOptions::TIMEOUT]);

        // test that the existing options are still present
        $this->assertSame('application/json', $api->getLastOptions()['requestOptions'][RequestOptions::HEADERS]['Accept']);
        $this->assertSame(15, $api->getLastOptions()['requestOptions'][RequestOptions::CONNECT_TIMEOUT]);
        $this->assertFalse($api->getLastOptions()['requestOptions'][RequestOptions::HTTP_ERRORS]);
    }
}
