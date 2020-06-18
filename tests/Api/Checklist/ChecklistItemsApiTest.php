<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Checklist;

use Semaio\TrelloApi\Api\Checklist\ChecklistItemsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class ChecklistItemsApiTest extends ApiTestCase
{
    protected $apiPath = 'checklists/#id#/checkItems';

    /**
     * @test
     */
    public function shouldGetAllItems(): void
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
    public function shouldUpdateItem(): void
    {
        $response = ['name' => 'Test item', 'state' => 'complete'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId);

        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeParentId, $this->fakeId, $response));
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
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldCreateItem(): void
    {
        $response = ['response'];

        $name = 'Test Item';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->create($this->fakeParentId, $name, [], true));
    }

    protected function getApiClass()
    {
        return ChecklistItemsApi::class;
    }
}
