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

    /**
     * Helper method to convert a \stdClass into an array
     *
     * @param $obj
     * @return array
     */
    public function objectToArray($obj) : array
    {
        if ($obj instanceof \stdClass) {
            $obj = json_decode(json_encode($obj), true);
        }

        return (array)$obj;
    }
}
