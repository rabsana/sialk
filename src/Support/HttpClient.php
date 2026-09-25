<?php

namespace Rabsana\Sialk\Support;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use Rabsana\Sialk\Contracts\Support\HttpClientInterface;
use Rabsana\Sialk\Exceptions\HttpClientException;
use Rabsana\Sialk\Services\QuestService;
use Throwable;

class HttpClient implements HttpClientInterface
{
    protected $provider = '-';

    protected $requestType = '-';

    protected Factory $client;

    public function __construct(Factory $client)
    {
        $this->client = $client;
    }

    public function post(string $baseUrl, string $uri, array $data = [], array $headers = []): Response
    {
        return $this->request($baseUrl, 'post', $uri, $data, $headers);
    }


    public function request(
        string $baseUrl,
        string $method,
        string $uri,
        array $data = [],
        array $headers = [],
    ): Response {
        try {
            $method = strtolower($method);

            if (! empty($uri)) {
                $endpoint = rtrim($baseUrl, '/').'/'.ltrim($uri, '/');
            } else {
                $endpoint = $baseUrl;
            }

            $quest = QuestService::getInstance();
            $quest->setRequestMethod($method)
                ->setRequestHeaders($headers)
                ->setRequestType($this->requestType)
                ->setThirdParty($this->provider)
                ->setRequestTime(strval(microtime(true) * 10000))
                ->setRequestBody($data)
                ->setEndpoint($endpoint);

            /**
             * @var Response $response
             */
            $response = $this->client
                ->withoutVerifying()
                ->asJson()
                ->acceptJson()
                ->withHeaders($headers)
                ->$method(
                    $endpoint,
                    $data,
                );

            $quest->setReason($response->reason())
                ->setResponseHeaders($response->headers())
                ->setResponseBody($response->json() ?? [])
                ->setResponseStatusCode($response->getStatusCode())
                ->setResponseTime(strval(microtime(true) * 10000))
                ->store();

            return $response;
        } catch (Throwable $exception) {
            if (isset($quest)) {
                $quest->setReason($exception->getMessage())
                    ->setResponseTime(strval(microtime(true) * 10000));
                $quest->store();
            }

            throw new HttpClientException($exception->getMessage());
        }
    }

    public function setRequestType(string $requestType): HttpClientInterface
    {
        $this->requestType = $requestType;

        return $this;
    }

    public function get(string $baseUrl, string $uri, array $params = [], array $headers = []): Response
    {
        return $this->request($baseUrl, 'get', $uri, $params, $headers);
    }

    public function put(string $baseUrl, string $uri, array $data = [], array $headers = []): Response
    {
        return $this->request($baseUrl, 'put', $uri, $data, $headers);
    }

    public function delete(string $baseUrl, string $uri, array $data = [], array $headers = []): Response
    {
        return $this->request($baseUrl, 'delete', $uri, $data, $headers);
    }

    public function setProvider(string $provider): HttpClientInterface
    {
        $this->provider = $provider;

        return $this;
    }
}
