<?php
namespace Dandomain\Tests;

require_once __DIR__ . '/../../../src/Dandomain/Api/Api.php';

class ApiTest extends \PHPUnit_Framework_TestCase
{
    public function testGetProduct()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->getMock('Dandomain\Api\Api');

        // Configure the stub.
        $stub->method('getProduct')
            ->willReturn('foo');

        // Calling $stub->doSomething() will now return
        // 'foo'.
        $this->assertEquals('foo', $stub->getProduct());
    }
}