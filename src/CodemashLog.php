<?php

namespace Codemash;

use Codemash\Exceptions\RequestValidationException;
use Codemash\Params\CodemashLogParams;
use GuzzleHttp\Exception\GuzzleException;

class CodemashLog
{
    private CodemashClient $client;
    private string $uriPrefix = 'v2/';

    public function __construct(CodemashClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function create(array $params): string
    {
        $params = CodemashLogParams::prepCreateParams($params);

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
