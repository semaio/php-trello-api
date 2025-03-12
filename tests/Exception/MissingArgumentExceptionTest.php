<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Exception;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Semaio\TrelloApi\Exception\MissingArgumentException;

class MissingArgumentExceptionTest extends TestCase
{
    /**
     * @var MissingArgumentException
     */
    protected MissingArgumentException $missingArgumentException;

    protected function setUp(): void
    {
        $this->missingArgumentException = new MissingArgumentException('message');
    }

    #[Test]
    public function it_can_retrieve_response_body(): void
    {
        static::assertEquals('One or more of required ("message") parameters are missing!', $this->missingArgumentException->getMessage());
    }
}
