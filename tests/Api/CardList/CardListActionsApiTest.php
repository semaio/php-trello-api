<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\CardList;

use Semaio\TrelloApi\Api\CardList\CardListActionsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class CardListActionsApiTest extends ApiTestCase
{
    protected $apiPath = 'lists/#id#/actions';

    /**
     * @test
     */
    public function shouldGetAllActions(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    protected function getApiClass()
    {
        return CardListActionsApi::class;
    }
}
