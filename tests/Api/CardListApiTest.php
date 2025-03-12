<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\CardList\CardListActionsApi;
use Semaio\TrelloApi\Api\CardList\CardListCardsApi;
use Semaio\TrelloApi\Api\CardListApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Exception\MissingArgumentException;

#[Group('unit')]
class CardListApiTest extends ApiTestCase
{
    protected string $fakeListId = '5461efc60872da1eca5bf45c';

    protected string $apiPath = 'lists';

    #[Test]
    public function shouldShowList(): void
    {
        $response = [
            'id' => $this->fakeListId,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('lists/'.$this->fakeListId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeListId));
    }

    #[Test]
    public function shouldCreateList(): void
    {
        $response = [
            'name' => 'Test List',
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
    }

    #[Test]
    public function shouldNotCreateListWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idBoard' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($data);
    }

    #[Test]
    public function shouldNotCreateListWithoutBoardId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'name' => 'Test List',
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($data);
    }

    #[Test]
    public function shouldUpdateList(): void
    {
        $response = [
            'name' => 'Test List',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeListId, $response));
    }

    #[Test]
    public function shouldSetBoard(): void
    {
        $response = ['response'];

        $lisId = $this->fakeId('list');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/idBoard')
            ->willReturn($response);

        static::assertEquals($response, $api->setBoard($this->fakeId, $lisId));
    }

    #[Test]
    public function shouldGetBoard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeListId.'/board')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoard($this->fakeListId));
    }

    #[Test]
    public function shouldGetBoardField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeListId.'/board/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoardField($this->fakeListId, 'name'));
    }

    #[Test]
    public function shouldNotGetUnexistingBoardField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects($this->never())->method('get');

        $api->getBoardField($this->fakeListId, 'unexisting');
    }

    #[Test]
    public function shouldSetName(): void
    {
        $response = ['response'];

        $name = 'Test Checklist';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/name')
            ->willReturn($response);

        static::assertEquals($response, $api->setName($this->fakeListId, $name));
    }

    #[Test]
    public function shouldSetPosition(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/pos')
            ->willReturn($response);

        static::assertEquals($response, $api->setPosition($this->fakeListId, 'top'));
    }

    #[Test]
    public function shouldSetPositionNumber(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/pos')
            ->willReturn($response);

        static::assertEquals($response, $api->setPositionNumber($this->fakeListId, 1));
    }

    #[Test]
    public function shouldSetClosed(): void
    {
        $response = ['response'];

        $closed = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/closed')
            ->willReturn($response);

        static::assertEquals($response, $api->setClosed($this->fakeListId, $closed));
    }

    #[Test]
    public function shouldSetSubscribed(): void
    {
        $response = ['response'];

        $subscribed = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeListId.'/subscribed')
            ->willReturn($response);

        static::assertEquals($response, $api->setSubscribed($this->fakeListId, $subscribed));
    }

    #[Test]
    public function shouldGetActionsApiObject(): void
    {
        static::assertInstanceOf(CardListActionsApi::class, $this->getApiMock()->actions());
    }

    #[Test]
    public function shouldGetCardsApiObject(): void
    {
        static::assertInstanceOf(CardListCardsApi::class, $this->getApiMock()->cards());
    }

    protected function getApiClass(): string
    {
        return CardListApi::class;
    }
}
