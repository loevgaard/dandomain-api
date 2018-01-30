<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Assert\InvalidArgumentException;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Loevgaard\Dandomain\Api\TestCase;

final class CustomerTest extends TestCase
{
    public function testGetCustomerException()
    {
        $this->expectException(InvalidArgumentException::class);
        $api = $this->getApi();
        $api->customer->getCustomer(0);
    }

    public function testGetCustomer()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'name' => 'name'
            ])),
        ]);

        $container = [];
        $history = Middleware::history($container);

        $handler = HandlerStack::create($mock);
        $handler->push($history);
        $client = new Client(['handler' => $handler]);

        $api = $this->getApi($client);
        $customer = $api->customer->getCustomer(1);

        $this->assertSame('name', $customer['name']);
        $this->assertCount(1, $container);

        foreach ($container as $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $this->assertSame('1', substr($request->getUri()->getPath(), -1));
        }
    }
}
