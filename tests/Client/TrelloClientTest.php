<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Client;

use JsonException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Semaio\TrelloApi\Client\HttpClientInterface;
use Semaio\TrelloApi\Client\TrelloClient;
use Semaio\TrelloApi\Client\TrelloClientInterface;
use Semaio\TrelloApi\Routing\UriGeneratorInterface;

class TrelloClientTest extends TestCase
{
    /**
     * @var HttpClientInterface|MockObject
     */
    protected MockObject|HttpClientInterface $httpClient;

    /**
     * @var UriGeneratorInterface|MockObject
     */
    protected MockObject|UriGeneratorInterface $uriGenerator;

    /**
     * @var ResponseInterface|MockObject
     */
    protected ResponseInterface|MockObject $response;

    /**
     * @var StreamInterface|MockObject
     */
    protected MockObject|StreamInterface $stream;

    /**
     * @var TrelloClient
     */
    protected TrelloClient $trelloClient;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->uriGenerator = $this->createMock(UriGeneratorInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->stream = $this->createMock(StreamInterface::class);

        $this->trelloClient = new TrelloClient(
            $this->httpClient,
            $this->uriGenerator
        );
    }

    #[Test]
    public function it_can_create_trello_client(): void
    {
        $client = TrelloClient::create($this->httpClient, $this->uriGenerator);

        static::assertInstanceOf(TrelloClientInterface::class, $client);
    }

    /**
     * @throws JsonException
     */
    #[Test]
    public function it_can_send_get_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with('GET', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->get('path', [
                'key' => 'value',
            ])
        );
    }

    /**
     * @throws JsonException
     */
    #[Test]
    public function it_can_send_head_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with('HEAD', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->head('path', [
                'key' => 'value',
            ])
        );
    }

    /**
     * @throws JsonException
     */
    #[Test]
    public function it_can_send_post_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with('POST', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->post('path', [
                'key' => 'value',
            ])
        );
    }

    /**
     * @throws JsonException
     */
    #[Test]
    public function it_can_send_patch_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with('PATCH', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->patch('path', [
                'key' => 'value',
            ])
        );
    }

    /**
     * @throws JsonException
     */
    #[Test]
    public function it_can_send_put_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with('PUT', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->put('path', [
                'key' => 'value',
            ])
        );
    }

    /**
     * @throws JsonException
     */
    #[Test]
    public function it_can_send_delete_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with('DELETE', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->delete('path', [
                'key' => 'value',
            ])
        );
    }
}
