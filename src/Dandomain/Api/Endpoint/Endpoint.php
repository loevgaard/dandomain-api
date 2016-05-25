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
    protected function getMaster()
    {
        return $this->master;
    }

    /**
     * @param mixed $val
     * @param string $varName
     */
    protected function assertString($val, $varName = 'Variable') {
        if(!is_string($val)) {
            throw new \InvalidArgumentException("$varName must be a string");
        }
    }

    /**
     * @param mixed $val
     * @param string $varName
     */
    protected function assertInteger($val, $varName = 'Variable') {
        if(!is_int($val)) {
            throw new \InvalidArgumentException("$varName must be an integer");
        }
    }

    /**
     * @param int $expected
     * @param int $actual
     * @param string $varName
     */
    protected function assertGreaterThan($expected, $actual, $varName = 'Variable') {
        if((int)$actual > (int)$expected) {
            throw new \InvalidArgumentException("$varName must be greater than $expected");
        }
    }

    /**
     * @param int $expected
     * @param int $actual
     * @param string $varName
     */
    protected function assertGreaterThanOrEqual($expected, $actual, $varName = 'Variable') {
        if((int)$actual >= (int)$expected) {
            throw new \InvalidArgumentException("$varName must be greater than or equal to $expected");
        }
    }

    /**
     * @param mixed $val
     * @param string $varName
     */
    protected function assertArray($val, $varName = 'Variable') {
        if(!is_array($val)) {
            throw new \InvalidArgumentException("$varName must be an array");
        }
    }
}