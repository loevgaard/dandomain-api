<?php
namespace Loevgaard\Dandomain\Api\Response;

interface ResponseInterface
{
    /**
     * Must return the original JSON response
     *
     * @return string
     */
    public function __toString();

    /**
     * Returns true if the request was successful
     *
     * @return bool
     */
    public function wasSuccessful() : bool;

    /**
     * Returns the json decoded response
     *
     * @return mixed
     */
    public function getParsedResponse();
}
