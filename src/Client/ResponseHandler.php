<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Client;

use Psr\Http\Message\ResponseInterface;
use Semaio\TrelloApi\Exception\InvalidJsonResponseException;

class ResponseHandler
{
    public static function handle(ResponseInterface $response): array
    {
        $body = $response->getBody()->getContents();

        $content = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidJsonResponseException($body);
        }

        return $content;
    }
}
