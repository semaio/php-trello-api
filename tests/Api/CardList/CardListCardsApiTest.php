<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\CardList;

use Semaio\TrelloApi\Api\CardList\CardListCardsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class CardListCardsApiTest extends ApiTestCase
{
    protected $apiPath = 'lists/#id#/cards';

    /**
     * @test
     */
    public function shouldGetAllCards(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldFilterCardsWithDefaultFilter(): void
    {
        $response = ['response'];

        $defaultFilter = 'all';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/'.$defaultFilter)
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldFilterCardsWithStringArgument(): void
    {
        $response = ['response'];

        $filter = 'open';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/open')
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldFilterCardsWithArrayArgument(): void
    {
        $response = ['response'];

        $filter = ['open', 'closed'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/open,closed')
            ->willReturn($response);

        static::assertEquals($response, $api->filters($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldCreateCard(): void
    {
        $response = ['response'];

        $name = 'Test card';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->create($this->fakeParentId, $name));
    }

    /**
     * @test
     */
    public function shouldArchiveAllCards(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with('lists/'.$this->fakeId.'/archiveAllCards')
            ->willReturn($response);

        static::assertEquals($response, $api->archiveAll($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldMoveAllCards(): void
    {
        $response = ['response'];

        $destId = $this->fakeId('destList');
        $boardId = $this->fakeId('board');

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with('lists/'.$this->fakeId.'/moveAllCards')
            ->willReturn($response);

        static::assertEquals($response, $api->moveAll($this->fakeId, $boardId, $destId));
    }

    protected function getApiClass()
    {
        return CardListCardsApi::class;
    }
}
