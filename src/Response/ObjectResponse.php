<?php
namespace Loevgaard\Dandomain\Api\Response;

class ObjectResponse extends Response implements \ArrayAccess
{
    /**
     * @return array
     */
    public function getParsedResponse() : array
    {
        return $this->parsedResponse;
    }

    /*
     * ArrayAccess methods
     */
    public function offsetExists($offset)
    {
        return isset($this->parsedResponse[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->parsedResponse[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        throw new \BadMethodCallException('The response data can not be manipulated');
    }

    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException('The response data can not be manipulated');
    }
}
