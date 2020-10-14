<?php

namespace Codemash;

use Codemash\Exceptions\RequestValidationException;
use Codemash\Params\CodemashAuthParams;
use GuzzleHttp\Exception\GuzzleException;

class CodemashAuth
{
    private CodemashClient $client;
    private string $uriPrefix = 'v2/auth/';

    public function __construct(CodemashClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function authenticate(array $params): array
    {
        $params = CodemashAuthParams::prepAuthenticateParams($params);

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
        $params = CodemashAuthParams::prepLogoutParams($params);

        return $this->client->request('POST', 'auth/logout', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $params['bearerToken'],
            ],
        ]);
    }
}
