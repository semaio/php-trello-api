<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use Semaio\TrelloApi\Api\CardList\CardListActionsApi;
use Semaio\TrelloApi\Api\CardList\CardListCardsApi;
use Semaio\TrelloApi\Api\CardListApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Exception\MissingArgumentException;

/**
 * @group unit
 */
class CardListApiTest extends ApiTestCase
{
    protected $fakeListId = '5461efc60872da1eca5bf45c';

    protected $apiPath = 'lists';

    /**
     * @test
     */
    public function shouldShowList(): void
    {
        $response = [
            'id' => $this->fakeListId,
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with('lists/'.$this->fakeListId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeListId));
    }

    /**
     * @test
     */
    public function shouldCreateList(): void
    {
        $response = [
            'name' => 'Test List',
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
    }

    /**
     * @test
     */
    public function shouldNotCreateListWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldNotCreateListWithoutBoardId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'name' => 'Test List',
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldUpdateList(): void
    {
        $response = [
            'name' => 'Test List',
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeListId, $response));
    }

    /**
     * @test
     */
    public function shouldSetBoard(): void
    {
        $response = ['response'];

        $lisId = $this->fakeId('list');

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/idBoard')
            ->willReturn($response);

        static::assertEquals($response, $api->setBoard($this->fakeId, $lisId));
    }

    /**
     * @test
     */
    public function shouldGetBoard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeListId.'/board')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoard($this->fakeListId));
    }

    /**
     * @test
     */
    public function shouldGetBoardField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeListId.'/board/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoardField($this->fakeListId, 'name'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingBoardField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getBoardField($this->fakeListId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetName(): void
    {
        $response = ['response'];

        $name = 'Test Checklist';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/name')
            ->willReturn($response);

        static::assertEquals($response, $api->setName($this->fakeListId, $name));
    }

    /**
     * @test
     */
    public function shouldSetPosition(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/pos')
            ->willReturn($response);

        static::assertEquals($response, $api->setPosition($this->fakeListId, 'top'));
    }

    /**
     * @test
     */
    public function shouldSetPositionNumber(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/pos')
            ->willReturn($response);

        static::assertEquals($response, $api->setPositionNumber($this->fakeListId, 1));
    }

    /**
     * @test
     */
    public function shouldSetClosed(): void
    {
        $response = ['response'];

        $closed = true;

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/closed')
            ->willReturn($response);

        static::assertEquals($response, $api->setClosed($this->fakeListId, $closed));
    }

    /**
     * @test
     */
    public function shouldSetSubscribed(): void
    {
        $response = ['response'];

        $subscribed = true;

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/subscribed')
            ->willReturn($response);

        static::assertEquals($response, $api->setSubscribed($this->fakeListId, $subscribed));
    }

    /**
     * @test
     */
    public function shouldGetActionsApiObject(): void
    {
        static::assertInstanceOf(CardListActionsApi::class, $this->getApiMock()->actions());
    }

    /**
     * @test
     */
    public function shouldGetCardsApiObject(): void
    {
        static::assertInstanceOf(CardListCardsApi::class, $this->getApiMock()->cards());
    }

    protected function getApiClass()
    {
        return CardListApi::class;
    }
}
