<?php
namespace Loevgaard\Dandomain\Api\KeyValueBuilder;

/**
 * The job of the key value builder is to make a fluent interface for creating a data structure like this:
 *
 * [
 *   'keyValues' => [
 *     ['Key' => 'property', 'Value' => 'new value of property']
 *   ]
 * ]
 *
 * to put into the patch methods
 */
class KeyValueBuilder
{
    /**
     * @var array
     */
    private $arr;

    private function __construct()
    {
        $this->arr = ['keyValues' => []];
    }

    public static function create() : KeyValueBuilder
    {
        return new self();
    }

    public function addPair(string $key, string $value) : KeyValueBuilder
    {
        $this->arr['keyValues'][] = [
            'Key' => $key, 'Value' => $value
        ];

        return $this;
    }

    public function build() : array
    {
        return $this->arr;
    }
}