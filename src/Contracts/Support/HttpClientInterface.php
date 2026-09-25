<?php

namespace Rabsana\Sialk\Contracts\Support;

use Illuminate\Http\Client\Response;
use Rabsana\Sialk\Exceptions\HttpClientException;

interface HttpClientInterface
{
    /**
     * @throws HttpClientException
     */
    public function request(string $baseUrl, string $method, string $uri, array $data = [], array $headers = []): Response;

    /**
     * @throws HttpClientException
     */
    public function post(string $baseUrl, string $uri, array $data = [], array $headers = []): Response;

    /**
     * @throws HttpClientException
     */
    public function get(string $baseUrl, string $uri, array $params = [], array $headers = []): Response;

    /**
     * @throws HttpClientException
     */
    public function put(string $baseUrl, string $uri, array $data = [], array $headers = []): Response;

    /**
     * @throws HttpClientException
     */
    public function delete(string $baseUrl, string $uri, array $data = [], array $headers = []): Response;

    public function setProvider(string $provider): HttpClientInterface;

    public function setRequestType(string $requestType): HttpClientInterface;
}
