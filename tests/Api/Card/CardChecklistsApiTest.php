<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use Semaio\TrelloApi\Api\Card\CardChecklistsApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class CardChecklistsApiTest extends ApiTestCase
{
    protected $apiPath = 'cards/#id#/checklists';

    /**
     * @test
     */
    public function shouldGetAllChecklists(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with('cards/'.$this->fakeParentId.'/checklists')
            ->willReturn($response);

        static::assertEquals($response, $api->all($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldCreateChecklist(): void
    {
        $data = [
            'name' => 'Test checklist',
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($data);

        static::assertEquals($data, $api->create($this->fakeParentId, $data));
    }

    /**
     * @test
     */
    public function shouldNotCreateChecklistWithoutNameSourceChecklistIdOrValue(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldRemoveChecklist(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldGetItemStates(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with('cards/'.$this->fakeParentId.'/checkItemStates')
            ->willReturn($response);

        static::assertEquals($response, $api->itemStates($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldUpdateItem(): void
    {
        $item = [
            'name' => 'Test',
            'state' => true,
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem/'.$this->fakeId)
            ->willReturn($item);

        static::assertEquals($item, $api->updateItem($this->fakeParentId, $this->fakeId('checklist'), $this->fakeId, $item));
    }

    /**
     * @test
     */
    public function shouldCreateItem(): void
    {
        $item = [
            'name' => 'Test',
            'state' => true,
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem')
            ->willReturn($item);

        static::assertEquals($item, $api->createItem($this->fakeParentId, $this->fakeId('checklist'), 'Test', $item));
    }

    /**
     * @test
     */
    public function shouldRemoveItem(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->removeItem($this->fakeParentId, $this->fakeId('checklist'), $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldConvertItemToCard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath().'/'.$this->fakeId('checklist').'/checkItem/'.$this->fakeId.'/convertToCard')
            ->willReturn($response);

        static::assertEquals($response, $api->convertItemToCard($this->fakeParentId, $this->fakeId('checklist'), $this->fakeId));
    }

    protected function getApiClass()
    {
        return CardChecklistsApi::class;
    }
}
