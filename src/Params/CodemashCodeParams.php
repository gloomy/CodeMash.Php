<?php

namespace Codemash\Params;

use Codemash\Exceptions\RequestValidationException;

class CodemashCodeParams
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
