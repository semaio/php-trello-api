<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Card\CardChecklistsApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class CardChecklistsApiTest extends ApiTestCase
{
    protected string $apiPath = 'cards/#id#/checklists';

    #[Test]
    public function shouldGetAllChecklists(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('cards/'.$this->fakeParentId.'/checklists')
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    #[Test]
    public function shouldCreateChecklist(): void
    {
        $data = [
            'name' => 'Test checklist',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($data);

        static::assertEquals($data, $api->create($this->fakeParentId, $data));
    }

    #[Test]
    public function shouldNotCreateChecklistWithoutNameSourceChecklistIdOrValue(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($this->fakeParentId, $data);
    }

    #[Test]
    public function shouldRemoveChecklist(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $this->fakeId));
    }

    #[Test]
    public function shouldGetItemStates(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('cards/'.$this->fakeParentId.'/checkItemStates')
            ->willReturn($response);

        static::assertEquals($response, $api->itemStates($this->fakeParentId));
    }

    #[Test]
    public function shouldUpdateItem(): void
    {
        $item = [
            'name' => 'Test',
            'state' => true,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem/'.$this->fakeId)
            ->willReturn($item);

        static::assertEquals($item, $api->updateItem($this->fakeParentId, $this->fakeId('checklist'), $this->fakeId, $item));
    }

    #[Test]
    public function shouldCreateItem(): void
    {
        $item = [
            'name' => 'Test',
            'state' => true,
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem')
            ->willReturn($item);

        static::assertEquals($item, $api->createItem($this->fakeParentId, $this->fakeId('checklist'), 'Test', $item));
    }

    #[Test]
    public function shouldRemoveItem(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->removeItem($this->fakeParentId, $this->fakeId('checklist'), $this->fakeId));
    }

    #[Test]
    public function shouldConvertItemToCard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem/'.$this->fakeId.'/convertToCard')
            ->willReturn($response);

        static::assertEquals($response, $api->convertItemToCard($this->fakeParentId, $this->fakeId('checklist'), $this->fakeId));
    }

    protected function getApiClass(): string
    {
        return CardChecklistsApi::class;
    }
}
