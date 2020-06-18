<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Client;

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
    protected $httpClient;

    /**
     * @var UriGeneratorInterface|MockObject
     */
    protected $uriGenerator;

    /**
     * @var ResponseInterface|MockObject
     */
    protected $response;

    /**
     * @var StreamInterface|MockObject
     */
    protected $stream;

    /**
     * @var TrelloClient
     */
    protected $trelloClient;

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

    /**
     * @test
     */
    public function it_can_create_trello_client(): void
    {
        $client = TrelloClient::create($this->httpClient, $this->uriGenerator);

        static::assertInstanceOf(TrelloClientInterface::class, $client);
    }

    /**
     * @test
     */
    public function it_can_send_get_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects(static::once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects(static::once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects(static::once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects(static::once())
            ->method('sendRequest')
            ->with('GET', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->get('path', ['key' => 'value'])
        );
    }

    /**
     * @test
     */
    public function it_can_send_head_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects(static::once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects(static::once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects(static::once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects(static::once())
            ->method('sendRequest')
            ->with('HEAD', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->head('path', ['key' => 'value'])
        );
    }

    /**
     * @test
     */
    public function it_can_send_post_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects(static::once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects(static::once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects(static::once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects(static::once())
            ->method('sendRequest')
            ->with('POST', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->post('path', ['key' => 'value'])
        );
    }

    /**
     * @test
     */
    public function it_can_send_patch_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects(static::once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects(static::once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects(static::once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects(static::once())
            ->method('sendRequest')
            ->with('PATCH', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->patch('path', ['key' => 'value'])
        );
    }

    /**
     * @test
     */
    public function it_can_send_put_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects(static::once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects(static::once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects(static::once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects(static::once())
            ->method('sendRequest')
            ->with('PUT', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->put('path', ['key' => 'value'])
        );
    }

    /**
     * @test
     */
    public function it_can_send_delete_requests(): void
    {
        $generatedUri = 'path?key=value';
        $contents = ['contents'];

        $this->uriGenerator->expects(static::once())
            ->method('generate')
            ->willReturn($generatedUri);

        $this->response->expects(static::once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects(static::once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects(static::once())
            ->method('sendRequest')
            ->with('DELETE', $generatedUri)
            ->willReturn($this->response);

        static::assertEquals(
            $contents,
            $this->trelloClient->delete('path', ['key' => 'value'])
        );
    }
}
