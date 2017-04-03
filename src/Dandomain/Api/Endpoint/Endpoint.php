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
     * @param array|\stdClass $obj
     * @param string $attr The attribute to validate
     * @param string $type Type we are expecting
     * @param bool $optional Whether the attribute is optional or not
     */
    protected function assertObjectAttribute($obj, $attr, $type, $optional = true) {
        $func = '';
        switch ($type) {
            case 'string':
                $func = 'is_string';
                break;
            case 'int':
            case 'integer':
                $func = 'is_int';
                break;
            case 'float':
            case 'double':
                $func = 'is_float';
                break;
            case 'bool':
            case 'boolean':
                $func = 'is_bool';
                break;
            case 'array':
                $func = 'is_array';
                break;
        }
        if(!$func) {
            throw new \InvalidArgumentException('$type is not valid');
        }

        $val = null;
        if(is_object($obj)) {
            $val = isset($obj->{$attr}) ?: null;
        } else {
            $val = isset($obj[$attr]) ?: null;
        }

        if($optional && is_null($val)) {
            return;
        }

        $res = call_user_func($func, $val);

        if(!$res) {
            throw new \InvalidArgumentException('Attribute '.$attr.' on object must be a(n) '.$type);
        }
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
    protected function assertLessThan($expected, $actual, $varName = 'Variable') {
        if((int)$actual >= (int)$expected) {
            throw new \InvalidArgumentException("$varName must be less than $expected");
        }
    }

    /**
     * @param int $expected
     * @param int $actual
     * @param string $varName
     */
    protected function assertLessThanOrEqual($expected, $actual, $varName = 'Variable') {
        if((int)$actual > (int)$expected) {
            throw new \InvalidArgumentException("$varName must be less than or equal to $expected");
        }
    }

    /**
     * @param int $expected
     * @param int $actual
     * @param string $varName
     */
    protected function assertGreaterThan($expected, $actual, $varName = 'Variable') {
        if((int)$actual <= (int)$expected) {
            throw new \InvalidArgumentException("$varName must be greater than $expected");
        }
    }

    /**
     * @param int $expected
     * @param int $actual
     * @param string $varName
     */
    protected function assertGreaterThanOrEqual($expected, $actual, $varName = 'Variable') {
        if((int)$actual < (int)$expected) {
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