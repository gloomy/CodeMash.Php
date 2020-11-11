<?php

namespace Codemash;

use Codemash\Exceptions\RequestValidationException;
use Codemash\Params\CodemashPushNotificationParams;
use GuzzleHttp\Exception\GuzzleException;

class CodemashPushNotification
{
    private CodemashClient $client;
    private string $uriPrefix = 'v2/notifications/push/';

    public function __construct(CodemashClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function getTemplate(array $params): array
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . 'templates/' . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     */
    public function getTemplates(): array
    {
        $response = $this->client->request('GET', $this->uriPrefix . 'templates', [
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
    public function sendNotification(array $params): string
    {
        $params = CodemashPushNotificationParams::prepSendNotificationParams($params);

        $response = $this->client->request('POST', $this->uriPrefix, [
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
    public function getNotification(array $params): array
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     */
    public function getNotifications(array $params = []): array
    {
        $params = CodemashPushNotificationParams::prepGetNotificationsParams($params);

        $response = $this->client->request('GET', $this->uriPrefix, [
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
     */
    public function getNotificationCount(array $params): array
    {
        $params = CodemashPushNotificationParams::prepGetNotificationsParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . 'count', [
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
    public function readNotification(array $params): int
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        return $this->client->request('PATCH', $this->uriPrefix . $params['id'] . '/read', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function deleteNotification(array $params)
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        return $this->client->request('DELETE', $this->uriPrefix . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
