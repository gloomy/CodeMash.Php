<?php

namespace Codemash\Params;

use Codemash\Exceptions\RequestValidationException;

class CodemashPushNotificationParams
{
    /**
     * @throws RequestValidationException
     */
    public static function prepGetByIdParams(array $params): array
    {
        $required = ['id'];

        validateRequiredRequestParams($required, $params);

        return [
            'id' => $params['id'],
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepSendNotificationParams(array $params): array
    {
        $required = ['templateId'];

        validateRequiredRequestParams($required, $params);

        return [
            'templateId' => $params['templateId'],
            'roles' => $params['roles'] ?? null,
            'users' => $params['users'] ?? null,
            'devices' => $params['devices'] ?? null,
            'isNonPushable' => $params['isNonPushable'] ?? false,
            'tokens' => $params['tokens'] ?? null,
            'postpone' => $params['postpone'] ?? null,
            'respectTimeZone' => $params['respectTimeZone'] ?? false,
        ];
    }

    public static function prepGetNotificationsParams(array $params): array
    {
        return [
            'userId' => $params['userId'] ?? null,
            'deviceId' => $params['deviceId'] ?? null,
        ];
    }
}
