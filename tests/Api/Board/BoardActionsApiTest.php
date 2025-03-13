<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Board\BoardActionsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class BoardActionsApiTest extends ApiTestCase
{
    protected string $apiPath = 'boards/#id#/actions';

    #[Test]
    public function shouldGetAllActions(): void
    {
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn([]);

        static::assertEquals([], $api->all($this->fakeParentId));
    }

    protected function getApiClass(): string
    {
        return BoardActionsApi::class;
    }
}
