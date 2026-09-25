<?php

namespace Rabsana\Sialk\Services;

use Exception;
use Rabsana\Sialk\Contracts\Services\QuestInterface;
use Rabsana\Sialk\Models\Quest;

class QuestService implements QuestInterface
{
    private Quest $quest;

    private function __construct()
    {
        $this->quest = Quest::make();
    }

    public static function getInstance(): QuestInterface
    {
        return new static;
    }

    public function setThirdParty(string $thirdParty): QuestInterface
    {
        $this->quest->third_party = $thirdParty;

        return $this;
    }

    public function setRequestType(string $type): QuestInterface
    {
        $this->quest->type = $type;

        return $this;
    }

    public function setReason(string $reason): QuestInterface
    {
        $this->quest->reason = $reason;

        return $this;
    }

    public function setResponseStatusCode(int $statusCode): QuestInterface
    {
        $this->quest->response_status_code = $statusCode;

        return $this;
    }

    public function setRequestMethod(string $method): QuestInterface
    {
        $this->quest->method = $method;

        return $this;
    }

    public function setRequestHeaders(array $headers): QuestInterface
    {
        $this->quest->request_headers = json_encode($headers);

        return $this;
    }

    public function setRequestQueryParams(array $queryParams): QuestInterface
    {
        $this->quest->request_query_params = json_encode($queryParams);

        return $this;
    }

    public function setRequestBody(array $body): QuestInterface
    {
        $this->quest->request_body = json_encode($body);

        return $this;
    }

    public function setResponseBody(array $body): QuestInterface
    {
        $this->quest->response_body = json_encode($body);

        return $this;
    }

    public function setResponseHeaders(array $headers): QuestInterface
    {
        $this->quest->response_headers = json_encode($headers);

        return $this;
    }

    public function setRequestTime(string $time): QuestInterface
    {
        $this->quest->request_time = $time;

        return $this;
    }

    public function setResponseTime(string $time): QuestInterface
    {
        $this->quest->response_time = $time;

        return $this;
    }

    public function setEndpoint(string $endpoint): QuestInterface
    {
        $this->quest->endpoint = $endpoint;

        return $this;
    }

    public function store(): bool
    {
        try {
            $this->quest->save();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
