<?php
namespace Dandomain\Api\Endpoint;

use Dandomain\Api\Api;

abstract class Endpoint {
    /**
     * @var Api
     */
    protected $master;

    public function __construct($master) {
        $this->master = $master;
    }

    /**
     * @return Api
     */
    public function getMaster()
    {
        return $this->master;
    }
}