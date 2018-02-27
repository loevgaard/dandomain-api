<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Loevgaard\Dandomain\Api\Client;

abstract class Endpoint
{
    /**
     * @var Client
     */
    protected $master;

    public function __construct(Client $master)
    {
        $this->master = $master;
    }
}
