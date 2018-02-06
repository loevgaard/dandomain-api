<?php
namespace Loevgaard\Dandomain\Api\KeyValue;

/**
 * The job of the key value builder is to make a fluent interface for creating a key value collection to put into the patch methods
 */
class KeyValueBuilder
{
    /**
     * @var KeyValueCollection
     */
    private $keyValueCollection;

    private function __construct()
    {
        $this->keyValueCollection = new KeyValueCollection();
    }

    public static function create() : KeyValueBuilder
    {
        return new self();
    }

    public function add(string $key, string $value) : KeyValueBuilder
    {
        $this->keyValueCollection->add($key, $value);

        return $this;
    }

    public function build() : KeyValueCollection
    {
        return $this->keyValueCollection;
    }
}
