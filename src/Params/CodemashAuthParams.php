<?php

namespace Codemash\Params;

use Codemash\Exceptions\RequestValidationException;

class CodemashAuthParams
{
    /**
     * @throws RequestValidationException
     */
    public static function prepAuthenticateParams(array $params): array
    {
        $required = ['password', 'userName'];

        validateRequiredRequestParams($required, $params);

        return [
            'password' => $params['password'],
            'userName' => $params['userName'],
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepLogoutParams(array $params): array
    {
        $required = ['bearerToken'];

        validateRequiredRequestParams($required, $params);

        return [
            'bearerToken' => $params['bearerToken'],
        ];
    }
}
