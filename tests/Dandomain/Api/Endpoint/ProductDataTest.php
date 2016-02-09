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
        $xml = "<note><to><firstname>Tove</firstname><lastname>Petersen</lastname></to><from>Jani</from><heading>Reminder</heading><body>Don't forget me this weekend!</body></note>";

        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'text/xml; charset=utf-8'], $xml),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new Api('http://www.example.com', 'apikey', $client);

        $response = $api->productData->getProductPageAsEntities(1, 10);

        return true;
    }
}