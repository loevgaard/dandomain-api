<?php
namespace Dandomain\Tests\Endpoint;

use Dandomain\Api\Api;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class ProductDataTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    public function testGetProductPageCount()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], json_encode(1)),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new Api('http://www.example.com', 'apikey', $client);

        $response = $api->productData->getProductPageCount(100);
        $pages = $response->getBody()->getContents();
        $this->assertTrue(is_numeric($pages));
    }

    public function testGetProductPageAsEntities() {
        $json = '[{
            "name": "example document for wicked fast parsing of huge json docs",
            "integer": 123,
            "totally sweet scientific notation": -123.123e-2,
            "unicode? you betcha!": "ú™£¢∞§\u2665",
            "zero character": "0",
            "null is boring": null
        },
        {
            "name": "another object",
            "cooler than first object?": true,
            "nested object": {
            "nested object?": true,
            "is nested array the same combination i have on my luggage?": true,
            "nested array": [1,2,3,4,5]
        },
        "false": false
        }]';
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], $json),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new Api('http://www.example.com', 'apikey', $client);

        $response = $api->productData->getProductPageAsEntities(1, 10);
    }
}