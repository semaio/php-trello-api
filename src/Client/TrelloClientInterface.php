<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Client;

interface TrelloClientInterface
{
    public const METHOD_GET = 'GET';
    public const METHOD_HEAD = 'HEAD';
    public const METHOD_POST = 'POST';
    public const METHOD_PATCH = 'PATCH';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    public function get(string $uri, array $parameters = [], array $headers = []): array;

    public function head(string $uri, array $parameters = [], array $headers = []): array;

    public function post(string $uri, $body = null, array $headers = []): array;

    public function patch(string $uri, $body = null, array $headers = []): array;

    public function put(string $uri, $body, array $headers = []): array;

    public function delete(string $uri, $body = null, array $headers = []): array;

    public function request(string $httpMethod, string $uri, array $parameters = [], array $headers = [], $body = null): array;
}
