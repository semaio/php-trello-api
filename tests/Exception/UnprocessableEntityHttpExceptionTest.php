<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Exception;

use JsonException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Semaio\TrelloApi\Exception\UnprocessableEntityHttpException;

/**
 * Class UnprocessableEntityHttpExceptionTest.
 */
class UnprocessableEntityHttpExceptionTest extends TestCase
{
    /**
     * @var RequestInterface|MockObject
     */
    protected MockObject|RequestInterface $request;

    /**
     * @var ResponseInterface|MockObject
     */
    protected ResponseInterface|MockObject $response;

    /**
     * @var UnprocessableEntityHttpException
     */
    protected UnprocessableEntityHttpException $unprocessableEntityHttpException;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);

        $this->response
            ->method('getStatusCode')
            ->willReturn(500);

        $this->unprocessableEntityHttpException = new UnprocessableEntityHttpException(
            'message',
            $this->request,
            $this->response
        );
    }

    /**
     * @throws Exception
     * @throws JsonException
     */
    public function testGetResponseErrors(): void
    {
        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $stream
            ->method('rewind')
            ->willReturnSelf();

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode(['contents']));

        $this->unprocessableEntityHttpException->getResponseErrors();
    }
}
