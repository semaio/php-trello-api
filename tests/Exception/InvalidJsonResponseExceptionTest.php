<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Exception;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Semaio\TrelloApi\Exception\InvalidJsonResponseException;

class InvalidJsonResponseExceptionTest extends TestCase
{
    /**
     * @var InvalidJsonResponseException
     */
    protected InvalidJsonResponseException $invalidJsonResponseException;

    protected function setUp(): void
    {
        $this->invalidJsonResponseException = new InvalidJsonResponseException('message');
    }

    #[Test]
    public function it_can_retrieve_response_body(): void
    {
        static::assertEquals('message', $this->invalidJsonResponseException->getResponseBody());
        static::assertEquals('', $this->invalidJsonResponseException->getMessage());
    }
}
