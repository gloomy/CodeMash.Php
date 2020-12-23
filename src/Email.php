<?php

namespace CodeMash;

use CodeMash\Exceptions\RequestValidationException;
use CodeMash\Params\EmailParams;
use GuzzleHttp\Exception\GuzzleException;

class Email
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
    public function send(array $params): string
    {
        $params = EmailParams::prepSendParams($params);

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
