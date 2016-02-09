<?php
namespace Dandomain\Api\Xml;

class Reader extends \XMLReader {
    public function __call($name, $arguments) {
        echo "Calling object method '$name' " . implode(', ', $arguments). "\n";
    }
}