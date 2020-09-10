<?php

namespace Codemash;

use GuzzleHttp\Exception\GuzzleException;
use function Couchbase\defaultDecoder;

class CodemashDb
{
    private CodemashClient $client;
    private string $uriPrefix = 'db/';

    public function __construct(CodemashClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function insertOneInCollection(
        string $collectionName,
        array $document,
        bool $bypassDocumentValidation = false,
        bool $waitForFileUpload = false,
        bool $ignoreTriggers = false
    ): array
    {
        return $this->client->request('POST', $this->uriPrefix . $collectionName, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson([
                'document' => toJson($document),
                'bypassDocumentValidation' => $bypassDocumentValidation,
                'waitForFileUpload' => $waitForFileUpload,
                'ignoreTriggers' => $ignoreTriggers,
            ])
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function insertManyInCollection(
        string $collectionName,
        array $documents,
        bool $bypassDocumentValidation = false,
        bool $ignoreTriggers = false
    ): array
    {
        return $this->client->request('POST', $this->uriPrefix . $collectionName . '/bulk', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson([
                'documents' => array_map('toJson', $documents),
                'bypassDocumentValidation' => $bypassDocumentValidation,
                'ignoreTriggers' => $ignoreTriggers,
            ])
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function countCollection(
        string $collectionName,
        ?array $filter = null,
        ?int $limit = null,
        ?int $skip = null
    ): int
    {
        return $this->client->request('GET', $this->uriPrefix . $collectionName . '/count', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson([
                'filter' => $filter ? toJson($filter) : null,
                'limit' => $limit,
                'skip' => $skip,
            ])
        ]);
    }
}
