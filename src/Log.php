<?php

namespace CodeMash;

use CodeMash\Exceptions\RequestValidationException;
use CodeMash\Params\LogParams;
use GuzzleHttp\Exception\GuzzleException;

class Log
{
    private Client $client;
    private string $uriPrefix = 'v2/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function create(array $params): string
    {
        $params = LogParams::prepCreateParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . 'logs', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }
}
