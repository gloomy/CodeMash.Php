<?php

namespace CodeMash\Params;

use CodeMash\Exceptions\RequestValidationException;

class DbParams
{
    /**
     * @throws RequestValidationException
     */
    public static function prepInsertOneParams(array $params): array
    {
        $required = ['collectionName', 'document'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'document' => toJson($params['document']),
            'bypassDocumentValidation' => $params['bypassDocumentValidation'] ?? false,
            'waitForFileUpload' => $params['waitForFileUpload'] ?? false,
            'ignoreTriggers' => $params['ignoreTriggers'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepInsertManyParams(array $params): array
    {
        $required = ['collectionName', 'documents'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'documents' => array_map('toJson', $params['documents']),
            'bypassDocumentValidation' => $params['bypassDocumentValidation'] ?? false,
            'ignoreTriggers' => $params['ignoreTriggers'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepGetParams(array $params): array
    {
        $required = ['collectionName', 'id'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'id' => $params['id'],
            'referencedFields' => $params['referencedFields'] ?? null,
            'addReferencesFirst' => $params['addReferencesFirst'] ?? false,
            'cultureCode' => $params['cultureCode'] ?? null,
            'projection' => $params['projection'] ?? null,
            'includeSchema' => $params['includeSchema'] ?? false,
            'excludeCulture' => $params['excludeCulture'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepFindOneParams(array $params): array
    {
        $required = ['collectionName', 'filter'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'filter' => toJson($params['filter']),
            'referencedFields' => $params['referencedFields'] ?? null,
            'addReferencesFirst' => $params['addReferencesFirst'] ?? false,
            'cultureCode' => $params['cultureCode'] ?? null,
            'projection' => $params['projection'] ?? null,
            'includeSchema' => $params['includeSchema'] ?? false,
            'excludeCulture' => $params['excludeCulture'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepFindManyParams(array $params): array
    {
        $required = ['collectionName', 'filter'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'filter' => toJson($params['filter']),
            'referencedFields' => $params['referencedFields'] ?? null,
            'addReferencesFirst' => $params['addReferencesFirst'] ?? false,
            'cultureCode' => $params['cultureCode'] ?? null,
            'sort' => $params['sort'] ?? null,
            'projection' => $params['projection'] ?? null,
            'pageSize' => $params['pageSize'] ?? null,
            'pageNumber' => $params['pageNumber'] ?? null,
            'includeSchema' => $params['includeSchema'] ?? false,
            'includeUserNames' => $params['includeUserNames'] ?? false,
            'includeRoleNames' => $params['includeRoleNames'] ?? false,
            'includeCollectionNames' => $params['includeCollectionNames'] ?? false,
            'includeTermNames' => $params['includeTermNames'] ?? false,
            'excludeCulture' => $params['excludeCulture'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepCountParams(array $params): array
    {
        $required = ['collectionName'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'filter' => ! empty($params['filter']) ? toJson($params['filter']) : null,
            'limit' => $params['limit'] ?? null,
            'skip' => $params['skip'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepGetAggregateParams(array $params): array
    {
        $required = ['collectionName'];

        if (empty($params['pipeline'])) {
            $required[] = 'id';
        }

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'id' => $params['id'] ?? null,
            'pipeline' => ! empty($params['pipeline']) ? array_map('toJson', $params['pipeline']) : null,
            'tokens' => ! empty($params['tokens']) ? (object) ($params['tokens']) : null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepReplaceOneParams(array $params): array
    {
        $required = ['collectionName', 'filter', 'document'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'filter' => toJson($params['filter']),
            'document' => toJson($params['document']),
            'bypassDocumentValidation' => $params['bypassDocumentValidation'] ?? false,
            'waitForFileUpload' => $params['waitForFileUpload'] ?? false,
            'isUpsert' => $params['isUpsert'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUpdateOneParams(array $params): array
    {
        $required = ['collectionName', 'id', 'update'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'id' => $params['id'],
            'update' => toJson($params['update']),
            'bypassDocumentValidation' => $params['bypassDocumentValidation'] ?? false,
            'waitForFileUpload' => $params['waitForFileUpload'] ?? false,
            'isUpsert' => $params['isUpsert'] ?? false,
            'ignoreTriggers' => $params['ignoreTriggers'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUpdateOneWithFilterParams(array $params): array
    {
        $required = ['collectionName', 'filter', 'update'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'filter' => toJson($params['filter']),
            'update' => toJson($params['update']),
            'bypassDocumentValidation' => $params['bypassDocumentValidation'] ?? false,
            'waitForFileUpload' => $params['waitForFileUpload'] ?? false,
            'isUpsert' => $params['isUpsert'] ?? false,
            'ignoreTriggers' => $params['ignoreTriggers'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepUpdateManyParams(array $params): array
    {
        $required = ['collectionName', 'filter', 'update'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'filter' => toJson($params['filter']),
            'update' => toJson($params['update']),
            'bypassDocumentValidation' => $params['bypassDocumentValidation'] ?? false,
            'isUpsert' => $params['isUpsert'] ?? false,
            'ignoreTriggers' => $params['ignoreTriggers'] ?? false,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepDeleteOneParams(array $params): array
    {
        $required = ['collectionName', 'id'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'id' => $params['id'],
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepDeleteWithFilterParams(array $params): array
    {
        $required = ['collectionName', 'filter'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'filter' => toJson($params['filter']),
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepGetDistinctParams(array $params): array
    {
        $required = ['collectionName', 'field'];

        validateRequiredRequestParams($required, $params);

        return [
            'collectionName' => $params['collectionName'],
            'field' => $params['field'],
            'filter' => ! empty($params['filter']) ? toJson($params['filter']) : null,
            'cultureCode' => $params['cultureCode'] ?? null,
        ];
    }

    /**
     * @throws RequestValidationException
     */
    public static function prepGetTaxonomyTerms(array $params): array
    {
        $required = ['taxonomyName', 'filter'];

        validateRequiredRequestParams($required, $params);

        return [
            'taxonomyName' => $params['taxonomyName'],
            'filter' => toJson($params['filter']),
            'cultureCode' => $params['cultureCode'] ?? null,
            'sort' => $params['sort'] ?? null,
            'projection' => $params['projection'] ?? null,
            'pageSize' => $params['pageSize'] ?? null,
            'pageNumber' => $params['pageNumber'] ?? null,
            'includeTaxonomy' => $params['includeTaxonomy'] ?? false,
            'excludeCulture' => $params['excludeCulture'] ?? false,
        ];
    }
}
