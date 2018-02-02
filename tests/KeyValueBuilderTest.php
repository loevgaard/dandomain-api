<?php
namespace Loevgaard\Dandomain\Api;

use Loevgaard\Dandomain\Api\KeyValueBuilder\KeyValueBuilder;

final class KeyValueBuilderTest extends TestCase
{
    public function testIt()
    {
        $expected = [
            'keyValues' => [
                ['Key' => 'key1', 'Value' => 'val1'],
                ['Key' => 'key2', 'Value' => 'val2']
            ]
        ];

        $result = KeyValueBuilder::create()->addPair('key1', 'val1')->addPair('key2', 'val2')->build();

        $this->assertSame($expected, $result);
    }
}
