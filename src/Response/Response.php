<?php
namespace Loevgaard\Dandomain\Api\Response;

use Loevgaard\Dandomain\Api\Exception\DecodeJsonException;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use function Loevgaard\Dandomain\Api\decodeJson;

abstract class Response implements ResponseInterface
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
     * @var mixed
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
}
