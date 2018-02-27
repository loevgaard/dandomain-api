<?php
namespace Loevgaard\Dandomain\Api;

use Loevgaard\Dandomain\Api\Exception\DecodeJsonException;
use Loevgaard\Dandomain\Api\Exception\EncodeJsonException;

/**
 * @param string $json
 * @return mixed
 * @throws DecodeJsonException
 */
function decodeJson(string $json)
{
    $data = \json_decode($json, true);
    if (JSON_ERROR_NONE !== json_last_error()) {
        throw new DecodeJsonException('json_decode error: ' . json_last_error_msg());
    }

    return $data;
}

/**
 * @param array $data
 * @return string
 * @throws EncodeJsonException
 */
function encodeJson(array $data) : string
{
    $json = \json_encode($data);
    if (JSON_ERROR_NONE !== json_last_error()) {
        throw new EncodeJsonException('json_encode error: ' . json_last_error_msg());
    }

    return $json;
}
