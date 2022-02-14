<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use Semaio\TrelloApi\Api\Card\CardActionsApi;
use Semaio\TrelloApi\Api\Card\CardAttachmentsApi;
use Semaio\TrelloApi\Api\Card\CardChecklistsApi;
use Semaio\TrelloApi\Api\Card\CardLabelsApi;
use Semaio\TrelloApi\Api\Card\CardMembersApi;
use Semaio\TrelloApi\Api\Card\CardStickersApi;
use Semaio\TrelloApi\Api\CardApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Exception\MissingArgumentException;

/**
 * @group unit
 */
class CardApiTest extends ApiTestCase
{
    protected $fakeCardId = '5461efc60872da1eca5bf45c';

    protected $apiPath = 'cards';

    /**
     * @test
     */
    public function shouldShowCard(): void
    {
        $response = [
            'id' => $this->fakeCardId,
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeCardId));
    }

    /**
     * @test
     */
    public function shouldCreateCard(): void
    {
        $response = [
            'name' => 'Test Card',
            'idList' => $this->fakeId('list'),
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
    public function shouldNotCreateCardWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idList' => $this->fakeId('list'),
            'desc' => 'Test Card Description',
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())
            ->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldNotCreateCardWithoutListId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'name' => 'Test Card',
            'desc' => 'Test Card Description',
        ];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldUpdateCard(): void
    {
        $response = [
            'name' => 'Test Card',
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeCardId, $response));
    }

    /**
     * @test
     */
    public function shouldGetField(): void
    {
        $response = ['response'];

        $field = 'desc';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/desc')
            ->willReturn($response);

        static::assertEquals($response, $api->getField($this->fakeCardId, $field));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getField($this->fakeCardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetName(): void
    {
        $name = 'Test Board';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/name')
            ->willReturn([$name]);

        static::assertEquals([$name], $api->setName($this->fakeCardId, $name));
    }

    /**
     * @test
     */
    public function shouldSetDescription(): void
    {
        $description = 'Test Card Description';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/desc')
            ->willReturn([$description]);

        static::assertEquals([$description], $api->setDescription($this->fakeCardId, $description));
    }

    /**
     * @test
     */
    public function shouldSetClosed(): void
    {
        $closed = true;

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/closed')
            ->willReturn([$closed]);

        static::assertEquals([$closed], $api->setClosed($this->fakeCardId, $closed));
    }

    /**
     * @test
     */
    public function shouldSetSubscribed(): void
    {
        $subscribed = true;

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/subscribed')
            ->willReturn([$subscribed]);

        static::assertEquals([$subscribed], $api->setSubscribed($this->fakeCardId, $subscribed));
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
            ->with($this->apiPath.'/'.$this->fakeCardId.'/pos')
            ->willReturn($response);

        static::assertEquals($response, $api->setPosition($this->fakeCardId, 'top'));
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
            ->with($this->apiPath.'/'.$this->fakeCardId.'/pos')
            ->willReturn($response);

        static::assertEquals($response, $api->setPositionNumber($this->fakeCardId, 1));
    }

    /**
     * @test
     */
    public function shouldSetDueDate(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/due')
            ->willReturn($response);

        static::assertEquals($response, $api->setDueDate($this->fakeCardId, new \DateTime('tomorrow')));
    }

    /**
     * @test
     */
    public function shouldSetList(): void
    {
        $response = ['response'];

        $listId = $this->fakeId('list');

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/idList')
            ->willReturn($response);

        static::assertEquals($response, $api->setList($this->fakeCardId, $listId));
    }

    /**
     * @test
     */
    public function shouldGetList(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/list')
            ->willReturn($response);

        static::assertEquals($response, $api->getList($this->fakeCardId));
    }

    /**
     * @test
     */
    public function shouldGetListField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/list/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getListField($this->fakeCardId, 'name'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingListField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getListField($this->fakeCardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetBoard(): void
    {
        $response = ['response'];

        $listId = $this->fakeId('list');

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeCardId.'/idBoard')
            ->willReturn($response);

        static::assertEquals($response, $api->setBoard($this->fakeCardId, $listId));
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
            ->with($this->apiPath.'/'.$this->fakeCardId.'/board')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoard($this->fakeCardId));
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
            ->with($this->apiPath.'/'.$this->fakeCardId.'/board/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoardField($this->fakeCardId, 'name'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingBoardField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getBoardField($this->fakeCardId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetActionsApiObject(): void
    {
        static::assertInstanceOf(CardActionsApi::class, $this->getApiMock()->actions());
    }

    /**
     * @test
     */
    public function shouldGetAttachmentsApiObject(): void
    {
        static::assertInstanceOf(CardAttachmentsApi::class, $this->getApiMock()->attachments());
    }

    /**
     * @test
     */
    public function shouldGetChecklistsApiObject(): void
    {
        static::assertInstanceOf(CardChecklistsApi::class, $this->getApiMock()->checklists());
    }

    /**
     * @test
     */
    public function shouldGetLabelsApiObject(): void
    {
        static::assertInstanceOf(CardLabelsApi::class, $this->getApiMock()->labels());
    }

    /**
     * @test
     */
    public function shouldGetMembersApiObject(): void
    {
        static::assertInstanceOf(CardMembersApi::class, $this->getApiMock()->members());
    }

    /**
     * @test
     */
    public function shouldGetStickersApiObject(): void
    {
        static::assertInstanceOf(CardStickersApi::class, $this->getApiMock()->stickers());
    }

    protected function getApiClass()
    {
        return CardApi::class;
    }
}
