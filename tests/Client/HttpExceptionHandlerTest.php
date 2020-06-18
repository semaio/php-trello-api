<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Client;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Semaio\TrelloApi\Client\HttpExceptionHandler;
use Semaio\TrelloApi\Exception\BadRequestHttpException;
use Semaio\TrelloApi\Exception\ClientErrorHttpException;
use Semaio\TrelloApi\Exception\NotFoundHttpException;
use Semaio\TrelloApi\Exception\RedirectionHttpException;
use Semaio\TrelloApi\Exception\ServerErrorHttpException;
use Semaio\TrelloApi\Exception\UnauthorizedHttpException;
use Semaio\TrelloApi\Exception\UnprocessableEntityHttpException;

/**
 * Class HttpExceptionHandlerTest.
 */
class HttpExceptionHandlerTest extends TestCase
{
    /**
     * @var HttpExceptionHandler
     */
    protected $httpExceptionHandler;

    /**
     * @var RequestInterface|MockObject
     */
    protected $request;

    /**
     * @var ResponseInterface|MockObject
     */
    protected $response;

    protected function setUp(): void
    {
        $this->httpExceptionHandler = new HttpExceptionHandler();
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
    }

    /**
     * @test
     */
    public function it_never_handles_successful_response(): void
    {
        $this->response->expects(static::any())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->response->expects(static::never())->method('getReasonPhrase');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    /**
     * @test
     */
    public function it_handles_redirection_http_exception(): void
    {
        $this->expectException(RedirectionHttpException::class);

        $this->response->expects(static::any())
            ->method('getStatusCode')
            ->willReturn(300);

        $this->response->expects(static::once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    /**
     * @test
     */
    public function it_handles_bad_request_http_exception(): void
    {
        $this->expectException(BadRequestHttpException::class);

        $this->response->expects(static::any())
            ->method('getStatusCode')
            ->willReturn(400);

        $this->response->expects(static::once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    /**
     * @test
     */
    public function it_handles_unauthorized_http_exception(): void
    {
        $this->expectException(UnauthorizedHttpException::class);

        $this->response->expects(static::any())
            ->method('getStatusCode')
            ->willReturn(401);

        $this->response->expects(static::once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    /**
     * @test
     */
    public function it_handles_not_found_http_exception(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->response->expects(static::any())
            ->method('getStatusCode')
            ->willReturn(404);

        $this->response->expects(static::once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    /**
     * @test
     */
    public function it_handles_unprocessable_entity_http_exception(): void
    {
        $this->expectException(UnprocessableEntityHttpException::class);

        $this->response->expects(static::any())
            ->method('getStatusCode')
            ->willReturn(422);

        $this->response->expects(static::once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    /**
     * @test
     */
    public function it_handles_client_error_http_exception(): void
    {
        $this->expectException(ClientErrorHttpException::class);

        $this->response->expects(static::any())
            ->method('getStatusCode')
            ->willReturn(429);

        $this->response->expects(static::once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    /**
     * @test
     */
    public function it_handles_server_error_http_exception(): void
    {
        $this->expectException(ServerErrorHttpException::class);

        $this->response->expects(static::any())
            ->method('getStatusCode')
            ->willReturn(500);

        $this->response->expects(static::once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }
}
