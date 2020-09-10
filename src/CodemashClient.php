<?php

namespace Codemash;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CodemashClient
{
    private Client $client;
    private array $headers;

    public function __construct(string $projectId, string $secretKey)
    {
        $this->client = new Client(['base_uri' => CODEMASH_API_URL]);
        $this->headers = [
            'X-CM-ProjectId' => $projectId,
            'Authorization' => 'Bearer ' . $secretKey,
        ];
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function request(string $method, string $uri, array $options = [])
    {
        if (! empty($options['headers'])) {
            $options['headers'] += $this->headers;
        } else {
            $options['headers'] = $this->headers;
        }

        $responseBody = jsonToArray((string) $this->client->request($method, $uri, $options)->getBody());

        return $responseBody['result'];
    }
}
