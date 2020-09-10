<?php

if (! function_exists('toJson')) {
    /**
     * @param mixed $val
     */
    function toJson($val): string
    {
        return \GuzzleHttp\json_encode($val);
    }
}

if (! function_exists('jsonToArray')) {
    function jsonToArray(string $val): array
    {
        return \GuzzleHttp\json_decode($val, true);
    }
}
