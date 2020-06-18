<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Client;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Interface HttpClientInterface.
 */
interface HttpClientInterface
{
    /**
     * @param StreamInterface|string $body
     */
    public function sendRequest(string $httpMethod, $uri, array $headers = [], $body = null): ResponseInterface;
}
