<?php

namespace CodeMash;

use CodeMash\Exceptions\RequestValidationException;
use CodeMash\Params\CodeParams;
use GuzzleHttp\Exception\GuzzleException;

class Code
{
    private Client $client;
    private string $uriPrefix = 'v2/serverless/functions/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function executeFunction(array $params): array
    {
        $params = CodeParams::prepExecuteFunctionParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . $params['id'] . '/execute', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return jsonToArray($response['result']);
    }
}
