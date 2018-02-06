<?php
namespace Loevgaard\Dandomain\Api\KeyValue;

/**
 * The key value collection will hold a data structure like this:
 *
 * [
 *   'keyValues' => [
 *     ['Key' => 'property', 'Value' => 'new value of property']
 *   ]
 * ]
 *
 * which can be used in the patch methods
 */
class KeyValueCollection implements \Countable
{
    /**
     * @var array
     */
    private $arr;

    public function __construct()
    {
        $this->arr = ['keyValues' => []];
    }

    public function add(string $key, string $value) : KeyValueCollection
    {
        $this->arr['keyValues'][] = [
            'Key' => $key, 'Value' => $value
        ];

        return $this;
    }

    public function get() : array
    {
        return $this->arr;
    }

    public function count()
    {
        return count($this->arr['keyValues']);
    }
}
