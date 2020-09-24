<?php

namespace Codemash;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CodemashClient
{
    private Client $client;
    private array $headers;

    public function __construct(string $secretKey, string $projectId)
    {
        $this->client = new Client(['base_uri' => CODEMASH_API_URL]);
        $this->headers = [
            'X-CM-ProjectId' => $projectId,
            'Authorization' => 'Bearer ' . $secretKey,
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function request(string $method, string $uri, array $options = []): array
    {
        if (! empty($options['headers'])) {
            $options['headers'] += $this->headers;
        } else {
            $options['headers'] = $this->headers;
        }

        return jsonToArray((string) $this->client->request($method, $uri, $options)->getBody());
    }
}
