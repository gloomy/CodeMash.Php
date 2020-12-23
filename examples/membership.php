<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$projectId = '';
$secretKey = '';

$httpOptions = ['base_uri' => CODEMASH_API_URL];

$httpClient = new \GuzzleHttp\Client($httpOptions);

$cmClient = new \CodeMash\Client($secretKey, $projectId, $httpClient);

$cmMembership = new \CodeMash\Membership($cmClient);

print_r($cmMembership->getUsers());
