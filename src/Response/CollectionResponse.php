<?php
namespace Loevgaard\Dandomain\Api\Response;

class CollectionResponse extends Response implements \Iterator
{
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
