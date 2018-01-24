<?php
namespace Loevgaard\Dandomain\Api;

/**
 * Return a \DateTime object based on a json string, i.e. '/Date(1484759471000+0100)/'
 *
 * @param $date
 * @param string|\DateTimeZone $timeZone
 * @return \DateTime
 */
function jsonDateToDate($date, $timeZone = null)
{
    preg_match('/([0-9]+)\+/', $date, $matches);
    if (!isset($matches[1])) {
        throw new \InvalidArgumentException('$date is not a valid JSON date. Input: ' . $date);
    }
    // remove the last three digits since the json date is given in milliseconds
    $timestamp = substr($matches[1], 0, -3);

    $dateTime = new \DateTime('@' . $timestamp, new \DateTimeZone('UTC'));

    if ($timeZone) {
        if (is_string($timeZone)) {
            $timeZone = new \DateTimeZone($timeZone);
        }
    } else {
        $timeZone = new \DateTimeZone('Europe/Copenhagen');
    }
    $dateTime->setTimezone($timeZone);

    return $dateTime;
}

function objectToArray($obj) : array
{
    if ($obj instanceof \stdClass) {
        $obj = json_decode(json_encode($obj), true);
    }

    return (array)$obj;
}