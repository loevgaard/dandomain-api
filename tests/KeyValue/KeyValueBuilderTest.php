<?php
namespace Loevgaard\Dandomain\Api\KeyValue;

use PHPUnit\Framework\TestCase;

final class KeyValueBuilderTest extends TestCase
{
    public function testIt()
    {
        $result = KeyValueBuilder::create()->add('key1', 'val1')->build();

        $this->assertInstanceOf(KeyValueCollection::class, $result);
    }
}
