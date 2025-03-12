<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\CardList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\CardList\CardListActionsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class CardListActionsApiTest extends ApiTestCase
{
    protected string $apiPath = 'lists/#id#/actions';

    #[Test]
    public function shouldGetAllActions(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    protected function getApiClass(): string
    {
        return CardListActionsApi::class;
    }
}
