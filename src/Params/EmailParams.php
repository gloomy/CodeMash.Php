<?php

namespace CodeMash\Params;

use CodeMash\Exceptions\RequestValidationException;

class EmailParams
{
    /**
     * @throws RequestValidationException
     */
    public static function prepSendParams(array $params): array
    {
        $required = ['templateId'];

        if (empty($params['emails'])) {
            $required[] = 'users';
        }

        validateRequiredRequestParams($required, $params);

        return [
            'templateId' => $params['templateId'],
            'cultureCode' => $params['cultureCode'] ?? null,
            'forceRequestLanguage' => $params['forceRequestLanguage'] ?? null,
            'roles' => $params['roles'] ?? null,
            'emails' => $params['emails'] ?? null,
            'users' => $params['users'] ?? null,
            'ccEmails' => $params['ccEmails'] ?? null,
            'ccUsers' => $params['ccUsers'] ?? null,
            'bccEmails' => $params['bccEmails'] ?? null,
            'bccUsers' => $params['bccUsers'] ?? null,
            'tokens' => $params['tokens'] ?? null,
            'postpone' => $params['postpone'] ?? null,
            'respectTimeZone' => $params['respectTimeZone'] ?? false,
        ];
    }
}
