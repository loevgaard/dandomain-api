<?php
namespace Loevgaard\Dandomain\Api\Endpoint;

use Loevgaard\Dandomain\Api\Api;

abstract class Endpoint
{
    /**
     * @var Api
     */
    protected $master;

    public function __construct(Api $master)
    {
        $this->master = $master;
    }
}
