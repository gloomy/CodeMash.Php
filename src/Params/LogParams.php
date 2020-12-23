<?php

namespace CodeMash\Params;

use CodeMash\Exceptions\RequestValidationException;

class LogParams
{
    /**
     * @throws RequestValidationException
     */
    public static function prepCreateParams(array $params): array
    {
        $required = ['message'];

        validateRequiredRequestParams($required, $params);

        return [
            'message' => $params['message'],
            'items' => $params['items'] ?? null,
            'level' => $params['level'] ?? null,
        ];
    }
}
