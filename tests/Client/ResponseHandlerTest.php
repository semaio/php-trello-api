<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Client;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Semaio\TrelloApi\Client\ResponseHandler;
use Semaio\TrelloApi\Exception\InvalidJsonResponseException;

/**
 * @see ResponseHandler
 */
class ResponseHandlerTest extends TestCase
{
    /**
     * @throws Exception
     */
    #[Test]
    public function it_can_handle_successful_response(): void
    {
        $expectedResponse = ['response'];

        $response = $this->createMock(ResponseInterface::class);
        $stream = $this->createMock(StreamInterface::class);

        $response->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($expectedResponse));

        static::assertEquals($expectedResponse, ResponseHandler::handle($response));
    }

    /**
     * @throws Exception
     */
    #[Test]
    public function it_will_not_handle_invalid_response(): void
    {
        $this->expectException(InvalidJsonResponseException::class);

        $response = $this->createMock(ResponseInterface::class);
        $stream = $this->createMock(StreamInterface::class);

        $response->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('{"avatarNumber": "2');

        ResponseHandler::handle($response);
    }
}
