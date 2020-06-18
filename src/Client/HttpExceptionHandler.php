<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Semaio\TrelloApi\Exception\BadRequestHttpException;
use Semaio\TrelloApi\Exception\ClientErrorHttpException;
use Semaio\TrelloApi\Exception\NotFoundHttpException;
use Semaio\TrelloApi\Exception\RedirectionHttpException;
use Semaio\TrelloApi\Exception\ServerErrorHttpException;
use Semaio\TrelloApi\Exception\UnauthorizedHttpException;
use Semaio\TrelloApi\Exception\UnprocessableEntityHttpException;

/**
 * Class HttpExceptionHandler.
 */
class HttpExceptionHandler
{
    public function handle(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if ($response->getStatusCode() >= 300 && $response->getStatusCode() < 400) {
            throw new RedirectionHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() === 400) {
            throw new BadRequestHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() === 401) {
            throw new UnauthorizedHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() === 404) {
            throw new NotFoundHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() === 422) {
            throw new UnprocessableEntityHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 500) {
            throw new ClientErrorHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() >= 500 && $response->getStatusCode() < 600) {
            throw new ServerErrorHttpException($response->getReasonPhrase(), $request, $response);
        }

        return $response;
    }
}
