<?php

declare(strict_types=1);

namespace Semaio\TrelloApi;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Semaio\TrelloApi\Client\HttpClient;
use Semaio\TrelloApi\Client\TrelloClient;
use Semaio\TrelloApi\Configuration\Configuration;
use Semaio\TrelloApi\Routing\UriGenerator;

class ClientBuilder
{
    /**
     * @var HttpClientInterface|null
     */
    private ?HttpClientInterface $httpClient = null;

    /**
     * @var RequestFactoryInterface|null
     */
    private ?RequestFactoryInterface $requestFactory = null;

    /**
     * @var StreamFactoryInterface|null
     */
    private ?StreamFactoryInterface $streamFactory = null;

    public function getHttpClient(): HttpClientInterface
    {
        if ($this->httpClient === null) {
            $this->httpClient = Psr18ClientDiscovery::find();
        }

        return $this->httpClient;
    }

    public function setHttpClient(HttpClientInterface $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    public function getRequestFactory(): RequestFactoryInterface
    {
        if ($this->requestFactory === null) {
            $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        }

        return $this->requestFactory;
    }

    public function setRequestFactory(RequestFactoryInterface $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
    }

    public function getStreamFactory(): StreamFactoryInterface
    {
        if ($this->streamFactory === null) {
            $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        }

        return $this->streamFactory;
    }

    public function setStreamFactory(StreamFactoryInterface $streamFactory): void
    {
        $this->streamFactory = $streamFactory;
    }

    public function build(string $apiKey, string $apiToken, int $apiVersion = 1): ClientInterface
    {
        $configuration = Configuration::create($apiKey, $apiToken, $apiVersion);
        $uriGenerator = UriGenerator::create($configuration);
        $httpClient = HttpClient::create($this->getHttpClient(), $this->getRequestFactory(), $this->getStreamFactory());
        $trelloClient = TrelloClient::create($httpClient, $uriGenerator);

        return Client::create($trelloClient);
    }
}
