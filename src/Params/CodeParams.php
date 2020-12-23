<?php

namespace CodeMash\Params;

use CodeMash\Exceptions\RequestValidationException;

class CodeParams
{
    /**
     * @throws RequestValidationException
     */
    public static function prepExecuteFunctionParams(array $params): array
    {
        $required = ['id'];

        validateRequiredRequestParams($required, $params);

        return [
            'id' => $params['id'],
            'template' => $params['template'] ?? null,
            'qualifier' => $params['qualifier'] ?? null,
        ];
    }
}
