<?php

namespace Codemash;

use Codemash\Exceptions\RequestValidationException;
use Codemash\Params\CodemashCodeParams;
use GuzzleHttp\Exception\GuzzleException;

class CodemashCode
{
    private CodemashClient $client;
    private string $uriPrefix = 'v2/serverless/functions/';

    public function __construct(CodemashClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function executeFunction(array $params): array
    {
        $params = CodemashCodeParams::prepExecuteFunctionParams($params);

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
