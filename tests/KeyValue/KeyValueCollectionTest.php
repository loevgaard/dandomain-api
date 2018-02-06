<?php
namespace Loevgaard\Dandomain\Api\KeyValue;

use Loevgaard\Dandomain\Api\TestCase;

final class KeyValueCollectionTest extends TestCase
{
    public function testGet()
    {
        $expected = [
            'keyValues' => [
                ['Key' => 'key1', 'Value' => 'val1'],
                ['Key' => 'key2', 'Value' => 'val2']
            ]
        ];

        $collection = new KeyValueCollection();
        $collection->add('key1', 'val1')->add('key2', 'val2');

        $this->assertSame($expected, $collection->get());
    }

    public function testCount()
    {
        $collection = new KeyValueCollection();
        $collection->add('key1', 'val1')->add('key2', 'val2');

        $this->assertCount(2, $collection);
    }
}
