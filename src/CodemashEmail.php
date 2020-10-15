<?php

namespace Codemash;

use Codemash\Exceptions\RequestValidationException;
use Codemash\Params\CodemashEmailParams;
use GuzzleHttp\Exception\GuzzleException;

class CodemashEmail
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
    public function send(array $params): string
    {
        $params = CodemashEmailParams::prepSendParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . 'notifications/email', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }
}
