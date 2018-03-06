<?php
namespace Loevgaard\Dandomain\Api\Response;

use Loevgaard\Dandomain\Api\Exception\DecodeJsonException;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class BoolResponse extends Response
{
    /**
     * @param PsrResponseInterface $response
     * @param RequestInterface $request
     * @throws DecodeJsonException
     */
    public function __construct(PsrResponseInterface $response, RequestInterface $request)
    {
        parent::__construct($response, $request);
        $this->parsedResponse = boolval($this->parsedResponse);
    }

    public function wasSuccessful() : bool
    {
        return parent::wasSuccessful() && $this->parsedResponse;
    }

    /**
     * @return bool
     */
    public function getParsedResponse() : bool
    {
        return parent::getParsedResponse();
    }
}
