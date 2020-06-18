<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Client;

use Semaio\TrelloApi\Routing\UriGeneratorInterface;

class TrelloClient implements TrelloClientInterface
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var UriGeneratorInterface
     */
    private $uriGenerator;

    /**
     * ResourceClient constructor.
     */
    public function __construct(HttpClientInterface $httpClient, UriGeneratorInterface $uriGenerator)
    {
        $this->httpClient = $httpClient;
        $this->uriGenerator = $uriGenerator;
    }

    public static function create(HttpClientInterface $httpClient, UriGeneratorInterface $uriGenerator): TrelloClientInterface
    {
        return new self($httpClient, $uriGenerator);
    }

    public function get(string $uri, array $parameters = [], array $headers = []): array
    {
        return $this->request(static::METHOD_GET, $uri, $parameters, $headers);
    }

    public function head(string $uri, array $parameters = [], array $headers = []): array
    {
        return $this->request(static::METHOD_HEAD, $uri, $parameters, $headers);
    }

    public function post(string $uri, $body = null, array $headers = []): array
    {
        return $this->request(static::METHOD_POST, $uri, $body, $headers);
    }

    public function patch(string $uri, $body = null, array $headers = []): array
    {
        return $this->request(static::METHOD_PATCH, $uri, [], $headers, $body);
    }

    public function put(string $uri, $body = null, array $headers = []): array
    {
        return $this->request(static::METHOD_PUT, $uri, $body, $headers);
    }

    public function delete(string $uri, $body = null, array $headers = []): array
    {
        return $this->request(static::METHOD_DELETE, $uri, [], $headers, $body);
    }

    /**
     * {@inheritdoc}
     */
    public function request(string $httpMethod, string $uri, array $parameters = [], array $headers = [], $body = null): array
    {
        $uri = $this->uriGenerator->generate($uri, $parameters);

        if ($body !== null) {
            $body = json_encode($body);
        }

        $response = $this->httpClient->sendRequest($httpMethod, $uri, $headers, $body);

        return ResponseHandler::handle($response);
    }
}
