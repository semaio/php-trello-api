<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\CardList;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\CardList\CardListCardsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class CardListCardsApiTest extends ApiTestCase
{
    protected string $apiPath = 'lists/#id#/cards';

    #[Test]
    public function shouldGetAllCards(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    #[Test]
    public function shouldFilterCardsWithDefaultFilter(): void
    {
        $response = ['response'];

        $defaultFilter = 'all';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$defaultFilter)
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId));
    }

    #[Test]
    public function shouldFilterCardsWithStringArgument(): void
    {
        $response = ['response'];

        $filter = 'open';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/open')
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId, $filter));
    }

    #[Test]
    public function shouldFilterCardsWithArrayArgument(): void
    {
        $response = ['response'];

        $filter = ['open', 'closed'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/open,closed')
            ->willReturn($response);

        static::assertEquals($response, $api->filters($this->fakeParentId, $filter));
    }

    #[Test]
    public function shouldCreateCard(): void
    {
        $response = ['response'];

        $name = 'Test card';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->create($this->fakeParentId, $name));
    }

    #[Test]
    public function shouldArchiveAllCards(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('lists/'.$this->fakeId.'/archiveAllCards')
            ->willReturn($response);

        static::assertEquals($response, $api->archiveAll($this->fakeId));
    }

    #[Test]
    public function shouldMoveAllCards(): void
    {
        $response = ['response'];

        $destId = $this->fakeId('destList');
        $boardId = $this->fakeId('board');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('lists/'.$this->fakeId.'/moveAllCards')
            ->willReturn($response);

        static::assertEquals($response, $api->moveAll($this->fakeId, $boardId, $destId));
    }

    protected function getApiClass(): string
    {
        return CardListCardsApi::class;
    }
}
