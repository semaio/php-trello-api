<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Semaio\TrelloApi\Exception\InvalidJsonResponseException;

class InvalidJsonResponseExceptionTest extends TestCase
{
    /**
     * @var InvalidJsonResponseException
     */
    protected $invalidJsonResponseException;

    protected function setUp(): void
    {
        $this->invalidJsonResponseException = new InvalidJsonResponseException('message');
    }

    /**
     * @test
     */
    public function it_can_retrieve_response_body(): void
    {
        static::assertEquals('message', $this->invalidJsonResponseException->getResponseBody());
        static::assertEquals('', $this->invalidJsonResponseException->getMessage());
    }
}
