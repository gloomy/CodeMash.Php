<?php

namespace CodeMash\Params;

use CodeMash\Exceptions\RequestValidationException;

class FileParams
{
    /**
     * @throws RequestValidationException
     */
    public static function prepUploadFileParams(array $params): array
    {
        $required = ['fileName'];

        if (empty($params['base64'])) {
            $required[] = 'fileUri';
        }

        validateRequiredRequestParams($required, $params);

        return [
            'base64' => $params['base64'] ?? null,
            'fileUri' => $params['fileUri'] ?? null,
            'fileName' => $params['fileName'],
            'fileType' => $params['fileType'] ?? null,
            'path' => $params['path'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUploadRecordFileParams(array $params): array
    {
        $required = ['collectionName', 'recordId', 'uniqueFieldName', 'fileName'];

        if (empty($params['base64'])) {
            $required[] = 'fileUri';
        }

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => strtolower($params['collectionName']),
            'recordId' => $params['recordId'],
            'uniqueFieldName' => $params['uniqueFieldName'],
            'base64' => $params['base64'] ?? null,
            'fileUri' => $params['fileUri'] ?? null,
            'fileName' => $params['fileName'],
            'fileType' => $params['fileType'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUploadUserFileParams(array $params): array
    {
        $required = ['userId', 'metaFieldName', 'fileName'];

        if (empty($params['base64'])) {
            $required[] = 'fileUri';
        }

        validateRequiredRequestParams($required, $params);

        return [
            'userId' => $params['userId'],
            'metaFieldName' => $params['metaFieldName'],
            'base64' => $params['base64'] ?? null,
            'fileUri' => $params['fileUri'] ?? null,
            'fileName' => $params['fileName'],
            'fileType' => $params['fileType'] ?? null,
        ];
    }
}
