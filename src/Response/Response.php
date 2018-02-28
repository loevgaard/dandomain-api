<?php
namespace Loevgaard\Dandomain\Api\Response;

use Loevgaard\Dandomain\Api\Exception\DecodeJsonException;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use function Loevgaard\Dandomain\Api\decodeJson;

class Response implements ResponseInterface, \ArrayAccess, \Iterator
{
    /**
     * @var PsrResponseInterface
     */
    protected $response;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $parsedResponse;

    /**
     * @param PsrResponseInterface $response
     * @param RequestInterface $request
     * @throws DecodeJsonException
     */
    public function __construct(PsrResponseInterface $response, RequestInterface $request)
    {
        $this->response = $response;
        $this->request = $request;
        $this->parsedResponse = decodeJson((string)$this->response->getBody());
    }

    public function __toString()
    {
        return (string)$this->response->getBody();
    }

    public function wasSuccessful() : bool
    {
        return $this->response->getStatusCode() >= 200 && $this->response->getStatusCode() < 300;
    }

    /**
     * @return mixed
     */
    public function getParsedResponse()
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

    /*
     * Iterator methods
     */
    public function current()
    {
        return \current($this->parsedResponse);
    }

    public function next()
    {
        \next($this->parsedResponse);
    }

    public function key()
    {
        return \key($this->parsedResponse);
    }

    public function valid()
    {
        $current = $this->current();

        return $current !== false;
    }

    public function rewind()
    {
        \reset($this->parsedResponse);
    }

}
