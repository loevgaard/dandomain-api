<?php
namespace Dandomain\Api\Endpoint;

use Assert\Assert;
use Dandomain\Api\Api;

abstract class Endpoint {
    /**
     * @var Api
     */
    protected $master;

    public function __construct($master) {
        $this->master = $master;
    }
}