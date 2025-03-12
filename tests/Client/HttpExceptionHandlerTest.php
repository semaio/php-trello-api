<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Client;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\Exception;
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
    protected HttpExceptionHandler $httpExceptionHandler;

    /**
     * @var RequestInterface|MockObject
     */
    protected MockObject|RequestInterface $request;

    /**
     * @var ResponseInterface|MockObject
     */
    protected ResponseInterface|MockObject $response;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->httpExceptionHandler = new HttpExceptionHandler();
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
    }

    #[Test]
    public function it_never_handles_successful_response(): void
    {
        $this->response
            ->method('getStatusCode')
            ->willReturn(200);

        $this->response->expects($this->never())->method('getReasonPhrase');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    #[Test]
    public function it_handles_redirection_http_exception(): void
    {
        $this->expectException(RedirectionHttpException::class);

        $this->response
            ->method('getStatusCode')
            ->willReturn(300);

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    #[Test]
    public function it_handles_bad_request_http_exception(): void
    {
        $this->expectException(BadRequestHttpException::class);

        $this->response
            ->method('getStatusCode')
            ->willReturn(400);

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    #[Test]
    public function it_handles_unauthorized_http_exception(): void
    {
        $this->expectException(UnauthorizedHttpException::class);

        $this->response
            ->method('getStatusCode')
            ->willReturn(401);

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    #[Test]
    public function it_handles_not_found_http_exception(): void
    {
        $this->expectException(NotFoundHttpException::class);

        $this->response
            ->method('getStatusCode')
            ->willReturn(404);

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    #[Test]
    public function it_handles_unprocessable_entity_http_exception(): void
    {
        $this->expectException(UnprocessableEntityHttpException::class);

        $this->response
            ->method('getStatusCode')
            ->willReturn(422);

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    #[Test]
    public function it_handles_client_error_http_exception(): void
    {
        $this->expectException(ClientErrorHttpException::class);

        $this->response
            ->method('getStatusCode')
            ->willReturn(429);

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    #[Test]
    public function it_handles_server_error_http_exception(): void
    {
        $this->expectException(ServerErrorHttpException::class);

        $this->response
            ->method('getStatusCode')
            ->willReturn(500);

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }
}
