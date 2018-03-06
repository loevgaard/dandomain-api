<?php
namespace Loevgaard\Dandomain\Api\Response;

use Loevgaard\Dandomain\Api\Exception\DecodeJsonException;
use Loevgaard\Dandomain\Api\Request\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class IntResponse extends Response
{
    /**
     * @param PsrResponseInterface $response
     * @param RequestInterface $request
     * @throws DecodeJsonException
     */
    public function __construct(PsrResponseInterface $response, RequestInterface $request)
    {
        parent::__construct($response, $request);
        $this->parsedResponse = intval($this->parsedResponse);
    }

    /**
     * @return int
     */
    public function getParsedResponse() : int
    {
        return parent::getParsedResponse();
    }
}
