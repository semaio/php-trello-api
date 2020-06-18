<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Exception;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpException.
 */
class HttpException extends RuntimeException implements ExceptionInterface
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * HttpException constructor.
     */
    public function __construct(
        string $message,
        RequestInterface $request,
        ResponseInterface $response,
        ?Exception $previous = null
    ) {
        parent::__construct($message, $response->getStatusCode(), $previous);

        $this->request = $request;
        $this->response = $response;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
