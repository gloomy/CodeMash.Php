<?php

namespace Codemash;

use Codemash\Exceptions\RequestValidationException;
use Codemash\Params\CodemashUserParams;
use GuzzleHttp\Exception\GuzzleException;

class CodemashUser
{
    private CodemashClient $client;
    private string $uriPrefix = 'v2/membership/users/';

    public function __construct(CodemashClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function register(array $params): array
    {
        $params = CodemashUserParams::prepRegisterParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . 'register', [
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
    public function invite(array $params): array
    {
        $params = CodemashUserParams::prepInviteParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . 'invite', [
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
    public function getUsers(?array $params = null): array
    {
        $params = CodemashUserParams::prepGetUsersParams($params);

        return $this->client->request('GET', $this->uriPrefix, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function getUser(array $params): array
    {
        $params = CodemashUserParams::prepGetUserParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . $params['id'], [
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
    public function getUserByEmail(array $params): array
    {
        $params = CodemashUserParams::prepGetUserByEmailParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . 'by-email', [
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
    public function updateProfile(array $params): int
    {
        $params = CodemashUserParams::prepUpdateProfileParams($params);

        return $this->client->request('PATCH', $this->uriPrefix . 'profile', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function updateUser(array $params): int
    {
        $params = CodemashUserParams::prepUpdateUserParams($params);

        return $this->client->request('PATCH', $this->uriPrefix . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function deleteUser(array $params): int
    {
        $params = CodemashUserParams::prepOnlyIdParams($params);

        return $this->client->request('DELETE', $this->uriPrefix . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function blockUser(array $params): int
    {
        $params = CodemashUserParams::prepOnlyIdParams($params);

        return $this->client->request('PATCH', $this->uriPrefix . $params['id'] . '/block', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function unblockUser(array $params): int
    {
        $params = CodemashUserParams::prepOnlyIdParams($params);

        return $this->client->request('PATCH', $this->uriPrefix . $params['id'] . '/unblock', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);
    }
}
