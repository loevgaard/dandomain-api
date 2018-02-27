<?php
namespace Loevgaard\Dandomain\Api;

use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getApi(ClientInterface $client = null) : Client
    {
        $api = new Client('https://example.com', 'apikeyapikeyapikeyapikeyapikeyapikey');

        if ($client) {
            $api->setClient($client);
        }

        return $api;
    }
}
