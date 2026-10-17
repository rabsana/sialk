<?php

namespace Rabsana\Sialk\Support;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
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

            $endpoint = $this->getEndpoint($baseUrl, $uri);

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

    public function postMultiPart(string $baseUrl, string $uri, array $files = [], array $data = [], array $headers = []): Response
    {
        try {
            $method = strtolower($method);

            $endpoint = $this->getEndpoint($baseUrl, $uri);

            $requestBody = array_merge(
                $data,
                Arr::mapWithKeys($files, function ($value, $key) {
                    return [$key => '***'];
                })
            );
            $quest = QuestService::getInstance();
            $quest->setRequestMethod($method)
                ->setRequestHeaders($headers)
                ->setRequestType($this->requestType)
                ->setThirdParty($this->provider)
                ->setRequestTime(strval(microtime(true) * 10000))
                ->setRequestBody($requestBody)
                ->setEndpoint($endpoint);

            $clientInstance = $this->client;
            foreach($files as $key => $value){
                $clientInstance = $clientInstance->attach($key, $value);
            }
            foreach($data as $key => $value){
                $clientInstance = $clientInstance->attach($key, $value);
            }

            /**
             * @var Response $response
             */
            $response = $clientInstance
                ->withoutVerifying()
                ->acceptJson()
                ->withHeaders($headers)
                ->post(
                    $endpoint
                );

            $quest->setReason($response->reason())
                ->setResponseHeaders($response->headers())
                ->setResponseBody($response->json() ?? [])
                ->setResponseStatusCode($response->getStatusCode())
                ->setResponseTime(strval(microtime(true) * 10000))
                ->store();

            return $response;
        }catch (Throwable $exception) {
            if (isset($quest)) {
                $quest->setReason($exception->getMessage())
                    ->setResponseTime(strval(microtime(true) * 10000));
                $quest->store();
            }

            throw new HttpClientException($exception->getMessage());
        }
    }

    public function setProvider(string $provider): HttpClientInterface
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @param string $baseUrl
     * @param string $uri
     * @return string
     */
    protected function getEndpoint(string $baseUrl, string $uri): string
    {
        if (!empty($uri)) {
            $endpoint = rtrim($baseUrl, '/') . '/' . ltrim($uri, '/');
        } else {
            $endpoint = $baseUrl;
        }
        return $endpoint;
    }
}
