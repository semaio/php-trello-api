<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Semaio\TrelloApi\Client\TrelloClientInterface;
use Semaio\TrelloApi\ClientBuilder;
use Semaio\TrelloApi\ClientInterface;

/**
 * Class ClientBuilderTest.
 */
class ClientBuilderTest extends TestCase
{
    /**
     * @var HttpClientInterface|MockObject
     */
    protected HttpClientInterface|MockObject $httpClient;

    /**
     * @var RequestFactoryInterface|MockObject
     */
    protected MockObject|RequestFactoryInterface $requestFactory;

    /**
     * @var StreamFactoryInterface|MockObject
     */
    protected MockObject|StreamFactoryInterface $streamFactory;

    /**
     * @var ClientBuilder
     */
    protected ClientBuilder $clientBuilder;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);
        $this->streamFactory = $this->createMock(StreamFactoryInterface::class);

        $this->clientBuilder = new ClientBuilder();
    }

    #[Test]
    public function it_can_retrieve_http_client_from_discovery(): void
    {
        static::assertNotSame($this->httpClient, $this->clientBuilder->getHttpClient());
    }

    #[Test]
    public function it_can_retrieve_http_client(): void
    {
        $this->clientBuilder->setHttpClient($this->httpClient);
        static::assertSame($this->httpClient, $this->clientBuilder->getHttpClient());
    }

    #[Test]
    public function it_can_retrieve_request_factory_from_discovery(): void
    {
        static::assertNotSame($this->requestFactory, $this->clientBuilder->getRequestFactory());
    }

    #[Test]
    public function it_can_retrieve_request_factory(): void
    {
        $this->clientBuilder->setRequestFactory($this->requestFactory);
        static::assertSame($this->requestFactory, $this->clientBuilder->getRequestFactory());
    }

    #[Test]
    public function it_can_retrieve_stream_factory_from_discovery(): void
    {
        static::assertNotSame($this->streamFactory, $this->clientBuilder->getStreamFactory());
    }

    #[Test]
    public function it_can_retrieve_stream_factory(): void
    {
        $this->clientBuilder->setStreamFactory($this->streamFactory);
        static::assertSame($this->streamFactory, $this->clientBuilder->getStreamFactory());
    }

    #[Test]
    public function it_can_retrieve_client(): void
    {
        $client = $this->clientBuilder->build('KEY', 'TOKEN');

        static::assertInstanceOf(ClientInterface::class, $client);
        static::assertInstanceOf(TrelloClientInterface::class, $client->getTrelloClient());
    }
}
