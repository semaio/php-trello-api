<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use Semaio\TrelloApi\Api\Board\BoardActionsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class BoardActionsApiTest extends ApiTestCase
{
    protected $apiPath = 'boards/#id#/actions';

    /**
     * @test
     */
    public function shouldGetAllActions(): void
    {
        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn([]);

        static::assertEquals([], $api->all($this->fakeParentId));
    }

    protected function getApiClass()
    {
        return BoardActionsApi::class;
    }
}
