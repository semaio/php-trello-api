<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Exception;

class InvalidJsonResponseException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var string
     */
    private $responseBody;

    public function __construct($message = '', $code = 0, ?\Throwable $previous = null)
    {
        $this->responseBody = $message;

        parent::__construct('', $code, $previous);
    }

    public function getResponseBody(): string
    {
        return $this->responseBody;
    }
}
