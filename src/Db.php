<?php

namespace CodeMash;

use CodeMash\Exceptions\RequestValidationException;
use CodeMash\Params\DbParams;
use GuzzleHttp\Exception\GuzzleException;

class Db
{
    private Client $client;
    private string $uriPrefix = 'v2/db/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function insertOne(array $params): array
    {
        $params = DbParams::prepInsertOneParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . $params['collectionName'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return jsonToArray($response['result']);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function insertMany(array $params): array
    {
        $params = DbParams::prepInsertManyParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . $params['collectionName'] . '/bulk', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function get(array $params): array
    {
        $params = DbParams::prepGetParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . $params['collectionName'] . '/' . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Accept-Language' => 'en',
            ],
            'body' => toJson($params),
        ]);

        return jsonToArray($response['result']);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function findOne(array $params): array
    {
        $params = DbParams::prepFindOneParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . $params['collectionName'] . '/findOne', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Accept-Language' => 'en',
            ],
            'body' => toJson($params),
        ]);

        return jsonToArray($response['result']);
    }

    public function findMany(array $params): array
    {
        $params = DbParams::prepFindManyParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . $params['collectionName'] . '/find', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Accept-Language' => 'en',
            ],
            'body' => toJson($params),
        ]);

        return jsonToArray($response['result']);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function count(array $params): int
    {
        $params = DbParams::prepCountParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . $params['collectionName'] . '/count', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function getAggregate(array $params): array
    {
        $params = DbParams::prepGetAggregateParams($params);

        $uri = ! empty($params['pipeline'])
            ? $this->uriPrefix . $params['collectionName'] . '/aggregate/pipeline'
            : $this->uriPrefix . $params['collectionName'] . '/aggregate/' . $params['id'];

        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return jsonToArray($response['result']);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function replaceOne(array $params): array
    {
        $params = DbParams::prepReplaceOneParams($params);

        $response = $this->client->request('PUT', $this->uriPrefix . $params['collectionName'] . '/replaceOne', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function updateOne(array $params): array
    {
        $params = DbParams::prepUpdateOneParams($params);

        $response = $this->client->request(
            'PATCH',
            $this->uriPrefix . $params['collectionName'] . '/' . $params['id'],
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => toJson($params),
            ]
        );

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function updateOneWithFilter(array $params): array
    {
        $params = DbParams::prepUpdateOneWithFilterParams($params);

        $response = $this->client->request('PATCH', $this->uriPrefix . $params['collectionName'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function updateMany(array $params): array
    {
        $params = DbParams::prepUpdateManyParams($params);

        $response = $this->client->request('PATCH', $this->uriPrefix . $params['collectionName'] . '/bulk', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function deleteOne(array $params): array
    {
        $params = DbParams::prepDeleteOneParams($params);

        $response = $this->client->request(
            'DELETE',
            $this->uriPrefix . $params['collectionName'] . '/' . $params['id'],
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => toJson($params),
            ]
        );

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function deleteOneWithFilter(array $params): array
    {
        $params = DbParams::prepDeleteWithFilterParams($params);

        $response = $this->client->request('DELETE', $this->uriPrefix . $params['collectionName'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function deleteMany(array $params): array
    {
        $params = DbParams::prepDeleteWithFilterParams($params);

        $response = $this->client->request('DELETE', $this->uriPrefix . $params['collectionName'] . '/bulk', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function getDistinct(array $params): array
    {
        $params = DbParams::prepGetDistinctParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . $params['collectionName'] . '/distinct', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function getTaxonomyTerms(array $params): array
    {
        $params = DbParams::prepGetTaxonomyTerms($params);

        $response = $this->client->request(
            'GET',
            $this->uriPrefix . '/taxonomies/' . $params['taxonomyName'] . '/terms',
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => toJson($params),
            ]
        );

        return $response['result'];
    }
}
