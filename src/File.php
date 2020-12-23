<?php

namespace CodeMash;

use CodeMash\Exceptions\RequestValidationException;
use CodeMash\Params\FileParams;
use GuzzleHttp\Exception\GuzzleException;

class File
{
    private Client $client;
    private string $uriPrefix = 'v2/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    private function prepUploadFileOptions(array $params): array
    {
        if ($params['base64']) {
            $options = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => toJson([
                    'base64File' => [
                        'data' => $params['base64'],
                        'contentType' => $params['fileType'],
                        'fileName' => $params['fileName'],
                    ],
                    'path' => $params['path'] ?? null,
                    'recordId' => $params['recordId'] ?? null,
                    'uniqueFieldName' => $params['uniqueFieldName'] ?? null,
                    'userId' => $params['userId'] ?? null,
                    'metaFieldName' => $params['metaFieldName'] ?? null,
                ]),
            ];
        } else {
            $options = [
                'multipart' => [
                    [
                        'name' => 'path',
                        'contents' => $params['path'] ?? null,
                    ],
                    [
                        'name' => 'recordId',
                        'contents' => $params['recordId'] ?? null,
                    ],
                    [
                        'name' => 'uniqueFieldName',
                        'contents' => $params['uniqueFieldName'] ?? null,
                    ],
                    [
                        'name' => 'userId',
                        'contents' => $params['userId'] ?? null,
                    ],
                    [
                        'name' => 'metaFieldName',
                        'contents' => $params['metaFieldName'] ?? null,
                    ],
                    [
                        'name'     => 'file',
                        'contents' => file_get_contents($params['fileUri']),
                        'filename' => $params['fileName'],
                    ],
                ],
            ];
        }

        return $options;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function uploadFile(array $params): array
    {
        $params = FileParams::prepUploadFileParams($params);

        $options = $this->prepUploadFileOptions($params);

        $response = $this->client->request('POST', $this->uriPrefix . 'files', $options);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function uploadRecordFile(array $params): array
    {
        $params = FileParams::prepUploadRecordFileParams($params);

        $options = $this->prepUploadFileOptions($params);

        $response = $this->client->request(
            'POST',
            $this->uriPrefix . 'db/' . $params['collectionName'] . '/files',
            $options
        );

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function uploadUserFile(array $params): array
    {
        $params = FileParams::prepUploadUserFileParams($params);

        $options = $this->prepUploadFileOptions($params);

        $response = $this->client->request('POST', $this->uriPrefix . 'membership/users/files', $options);

        return $response['result'];
    }
}
