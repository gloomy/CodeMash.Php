<?php

namespace CodeMash;

use CodeMash\Exceptions\RequestValidationException;
use CodeMash\Params\AuthParams;
use GuzzleHttp\Exception\GuzzleException;

class Auth
{
    private Client $client;
    private string $uriPrefix = 'v2/auth/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function authenticate(array $params): array
    {
        $params = AuthParams::prepAuthenticateParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . 'credentials', [
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
    public function checkAuth(): array
    {
        $response = $this->client->request('POST', $this->uriPrefix, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function logout(array $params): array
    {
        $params = AuthParams::prepLogoutParams($params);

        return $this->client->request('POST', 'auth/logout', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $params['bearerToken'],
            ],
        ]);
    }
}
