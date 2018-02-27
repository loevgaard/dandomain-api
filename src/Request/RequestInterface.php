<?php
namespace Loevgaard\Dandomain\Api\Request;

interface RequestInterface
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';

    /**
     * Returns the HTTP method
     *
     * @return string
     */
    public function getMethod() : string;

    /**
     * Returns the uri
     *
     * @return string
     */
    public function getUri() : string;

    /**
     * Returns a body array or an empty array if no body should be sent
     *
     * @return array
     */
    public function getBody() : array;

    /**
     * Must return the response class that matches the request, else use the generic Response class
     *
     * @return string
     */
    public function getResponseClass() : string;
}
