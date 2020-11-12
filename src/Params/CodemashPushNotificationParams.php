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

    public static function prepRegisterDeviceParams(array $params): array
    {
        return [
            'userId' => $params['userId'] ?? null,
            'timeZone' => $params['timeZone'] ?? null,
            'meta' => $params['meta'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepRegisterExpoTokenParams(array $params): array
    {
        $required = ['token'];

        validateRequiredRequestParams($required, $params);

        return [
            'token' => $params['token'],
            'deviceId' => $params['deviceId'] ?? null,
            'userId' => $params['userId'] ?? null,
            'timeZone' => $params['timeZone'] ?? null,
            'meta' => $params['meta'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUpdateDeviceMetaParams(array $params): array
    {
        $required = ['id'];

        validateRequiredRequestParams($required, $params);

        return [
            'id' => $params['id'],
            'meta' => $params['meta'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUpdateDeviceTimezoneParams(array $params): array
    {
        $required = ['id'];

        validateRequiredRequestParams($required, $params);

        return [
            'id' => $params['id'],
            'timezone' => $params['timezone'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUpdateDeviceUserParams(array $params): array
    {
        $required = ['id'];

        validateRequiredRequestParams($required, $params);

        return [
            'id' => $params['id'],
            'userId' => $params['userId'] ?? null,
        ];
    }
}
