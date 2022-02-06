<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Exception;

/**
 * Class UnprocessableEntityHttpException.
 */
class UnprocessableEntityHttpException extends ClientErrorHttpException
{
    /**
     * Returns the response errors if there are any.
     *
     * @throws \JsonException
     */
    public function getResponseErrors(): array
    {
        $responseBody = $this->response->getBody();
        $responseBody->rewind();
        $decodedBody = json_decode($responseBody->getContents(), true, 512, JSON_THROW_ON_ERROR);
        $responseBody->rewind();

        return $decodedBody['errors'] ?? [];
    }
}
