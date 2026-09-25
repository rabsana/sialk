<?php

namespace Rabsana\Sialk\Contracts\Services;

interface QuestInterface
{
    public static function getInstance(): QuestInterface;

    public function setEndpoint(string $endpoint): QuestInterface;

    public function setThirdParty(string $thirdParty): QuestInterface;

    public function setRequestType(string $type): QuestInterface;

    public function setReason(string $reason): QuestInterface;

    public function setResponseStatusCode(int $statusCode): QuestInterface;

    public function setRequestMethod(string $method): QuestInterface;

    public function setRequestHeaders(array $headers): QuestInterface;

    public function setRequestQueryParams(array $queryParams): QuestInterface;

    public function setRequestBody(array $body): QuestInterface;

    public function setResponseBody(array $body): QuestInterface;

    public function setResponseHeaders(array $headers): QuestInterface;

    public function setRequestTime(string $time): QuestInterface;

    public function setResponseTime(string $time): QuestInterface;

    public function store(): bool;
}
