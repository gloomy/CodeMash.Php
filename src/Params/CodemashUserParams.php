<?php

namespace Codemash\Params;

use Codemash\Exceptions\RequestValidationException;

class CodemashUserParams
{
    /**
     * @throws RequestValidationException
     */
    public static function prepRegisterParams(array $params): array
    {
        $required = ['email', 'password'];

        validateRequiredRequestParams($required, $params);

        return [
            'email' => $params['email'],
            'password' => $params['password'],
            'displayName' => $params['displayName'] ?? null,
            'firstName' => $params['firstName'] ?? null,
            'lastName' => $params['lastName'] ?? null,
            'roles' => $params['roles'] ?? null,
            'autoLogin' => $params['autoLogin'] ?? false,
            'meta' => $params['meta'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepInviteParams(array $params): array
    {
        $required = ['email'];

        validateRequiredRequestParams($required, $params);

        return [
            'email' => $params['email'],
            'displayName' => $params['displayName'] ?? null,
            'firstName' => $params['firstName'] ?? null,
            'lastName' => $params['lastName'] ?? null,
            'roles' => $params['roles'] ?? null,
            'meta' => $params['meta'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepGetUsersParams(?array $params): ?array
    {
        if (! $params) {
            return null;
        }

        return [
            'includePermissions' => $params['includePermissions'] ?? false,
            'includeDevices' => $params['includeDevices'] ?? false,
            'includeMeta' => $params['includeMeta'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepGetUserParams(array $params): array
    {
        $required = ['id'];

        validateRequiredRequestParams($required, $params);

        return [
            'id' => $params['id'],
            'IncludeUnreadNotifications' => $params['IncludeUnreadNotifications'] ?? false,
            'includePermissions' => $params['includePermissions'] ?? false,
            'includeDevices' => $params['includeDevices'] ?? false,
            'includeMeta' => $params['includeMeta'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepGetUserByEmailParams(array $params): array
    {
        $required = ['email'];

        validateRequiredRequestParams($required, $params);

        return [
            'email' => $params['email'],
            'IncludeUnreadNotifications' => $params['IncludeUnreadNotifications'] ?? false,
            'includePermissions' => $params['includePermissions'] ?? false,
            'includeDevices' => $params['includeDevices'] ?? false,
            'includeMeta' => $params['includeMeta'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUpdateProfileParams(array $params): array
    {
        return [
            'unsubscribedNewsTags' => $params['unsubscribedNewsTags'] ?? null,
            'subscribeToNews' => $params['subscribeToNews'] ?? false,
            'timeZone' => $params['timeZone'] ?? null,
            'language' => $params['language'] ?? null,
            'displayName' => $params['displayName'] ?? null,
            'firstName' => $params['firstName'] ?? null,
            'lastName' => $params['lastName'] ?? null,
            'meta' => $params['meta'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUpdateUserParams(array $params): array
    {
        $required = ['id'];

        validateRequiredRequestParams($required, $params);

        return [
            'id' => $params['id'],
            'unsubscribedNewsTags' => $params['unsubscribedNewsTags'] ?? null,
            'subscribeToNews' => $params['subscribeToNews'] ?? false,
            'timeZone' => $params['timeZone'] ?? null,
            'language' => $params['language'] ?? null,
            'displayName' => $params['displayName'] ?? null,
            'firstName' => $params['firstName'] ?? null,
            'lastName' => $params['lastName'] ?? null,
            'roles' => $params['roles'] ?? null,
            'meta' => $params['meta'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepOnlyIdParams(array $params): array
    {
        $required = ['id'];

        validateRequiredRequestParams($required, $params);

        return [
            'id' => $params['id'],
        ];
    }
}
