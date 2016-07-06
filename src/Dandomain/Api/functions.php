<?php
namespace Dandomain\Api;

function jsonDateToDate($date) {
    preg_match('/[0-9]{10,}/', $date, $matches);
    if(!isset($matches[0])) {
        throw new \InvalidArgumentException('$date is not a valid JSON date. Input: ' . $date);
    }
    return new \DateTime('@' . substr($matches[0], 0, -3));
}