<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Exception;

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
    protected $request;

    /**
     * @var ResponseInterface|MockObject
     */
    protected $response;

    /**
     * @var UnprocessableEntityHttpException
     */
    protected $unprocessableEntityHttpException;

    protected function setUp(): void
    {
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);

        $this->response->expects(static::any())
            ->method('getStatusCode')
            ->willReturn(500);

        $this->unprocessableEntityHttpException = new UnprocessableEntityHttpException(
            'message',
            $this->request,
            $this->response
        );
    }

    public function testGetResponseErrors(): void
    {
        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects(static::once())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects(static::any())
            ->method('rewind')
            ->willReturnSelf();

        $stream->expects(static::once())
            ->method('getContents')
            ->willReturn(json_encode(['contents']));

        $this->unprocessableEntityHttpException->getResponseErrors();
    }
}
