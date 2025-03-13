<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Client;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class HttpClient.
 */
class HttpClient implements HttpClientInterface
{
    /**
     * @var HttpExceptionHandler
     */
    protected HttpExceptionHandler $httpExceptionHandler;

    /**
     * HttpClient constructor.
     */
    public function __construct(
        protected ClientInterface $baseHttpClient,
        protected RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface $streamFactory
    ) {
        $this->httpExceptionHandler = new HttpExceptionHandler();
    }

    public static function create(ClientInterface $baseHttpClient, RequestFactoryInterface $requestFactory, StreamFactoryInterface $streamFactory): HttpClientInterface
    {
        return new self($baseHttpClient, $requestFactory, $streamFactory);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function sendRequest(string $httpMethod, $uri, array $headers = [], $body = null): ResponseInterface
    {
        $request = $this->requestFactory->createRequest($httpMethod, $uri);

        if (is_string($body)) {
            $request = $request->withBody($this->streamFactory->createStream($body));
        }

        if ($body instanceof StreamInterface) {
            $request = $request->withBody($body);
        }

        foreach ($headers as $header => $content) {
            $request = $request->withHeader($header, $content);
        }

        $response = $this->baseHttpClient->sendRequest($request);

        return $this->httpExceptionHandler->handle($request, $response);
    }
}
