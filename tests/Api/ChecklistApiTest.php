<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Checklist\ChecklistCardsApi;
use Semaio\TrelloApi\Api\Checklist\ChecklistItemsApi;
use Semaio\TrelloApi\Api\ChecklistApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Exception\MissingArgumentException;

#[Group('unit')]
class ChecklistApiTest extends ApiTestCase
{
    protected string $fakeChecklistId = '5461efc60872da1eca5bf45c';

    protected string $apiPath = 'checklists';

    #[Test]
    public function shouldShowChecklist(): void
    {
        $response = [
            'id' => $this->fakeChecklistId,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeChecklistId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeChecklistId));
    }

    #[Test]
    public function shouldCreateChecklist(): void
    {
        $response = [
            'name' => 'Test Checklist',
            'idCard' => $this->fakeId('list'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
    }

    #[Test]
    public function shouldNotCreateChecklistWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'idCard' => $this->fakeId('list'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($data);
    }

    #[Test]
    public function shouldNotCreateChecklistWithoutCardId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'name' => 'Test Checklist',
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($data);
    }

    #[Test]
    public function shouldUpdateChecklist(): void
    {
        $response = [
            'name' => 'Test Checklist',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeChecklistId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeChecklistId, $response));
    }

    #[Test]
    public function shouldRemoveChecklist(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeChecklistId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeChecklistId));
    }

    #[Test]
    public function shouldGetField(): void
    {
        $response = ['response'];

        $field = 'name';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getField($this->fakeChecklistId, $field));
    }

    #[Test]
    public function shouldGetBoard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/board')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoard($this->fakeChecklistId));
    }

    #[Test]
    public function shouldGetBoardField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/board/name')
            ->willReturn($response);

        static::assertEquals($response, $api->getBoardField($this->fakeChecklistId, 'name'));
    }

    #[Test]
    public function shouldNotGetUnexistingBoardField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects($this->never())->method('get');

        $api->getBoardField($this->fakeChecklistId, 'unexisting');
    }

    #[Test]
    public function shouldSetCard(): void
    {
        $response = ['response'];

        $card = $this->fakeId('card');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/idCard')
            ->willReturn($response);

        static::assertEquals($response, $api->setCard($this->fakeChecklistId, $card));
    }

    #[Test]
    public function shouldSetName(): void
    {
        $response = ['response'];

        $name = 'Test Checklist';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/name')
            ->willReturn($response);

        static::assertEquals($response, $api->setName($this->fakeChecklistId, $name));
    }

    #[Test]
    public function shouldSetPosition(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/pos')
            ->willReturn($response);

        static::assertEquals($response, $api->setPosition($this->fakeChecklistId, 'top'));
    }

    #[Test]
    public function shouldSetPositionNumber(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeChecklistId.'/pos')
            ->willReturn($response);

        static::assertEquals($response, $api->setPositionNumber($this->fakeChecklistId, 1));
    }

    #[Test]
    public function shouldGetItemsApiObject(): void
    {
        static::assertInstanceOf(ChecklistItemsApi::class, $this->getApiMock()->items());
    }

    #[Test]
    public function shouldGetCardsApiObject(): void
    {
        static::assertInstanceOf(ChecklistCardsApi::class, $this->getApiMock()->cards());
    }

    protected function getApiClass(): string
    {
        return ChecklistApi::class;
    }
}
