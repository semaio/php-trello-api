<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Checklist;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Checklist\ChecklistItemsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class ChecklistItemsApiTest extends ApiTestCase
{
    protected string $apiPath = 'checklists/#id#/checkItems';

    #[Test]
    public function shouldGetAllItems(): void
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
    public function shouldUpdateItem(): void
    {
        $response = [
            'name' => 'Test item',
            'state' => 'complete',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId);

        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeParentId, $this->fakeId, $response));
    }

    #[Test]
    public function shouldRemoveItem(): void
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
    public function shouldCreateItem(): void
    {
        $response = ['response'];

        $name = 'Test Item';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->create($this->fakeParentId, $name, [], true));
    }

    protected function getApiClass(): string
    {
        return ChecklistItemsApi::class;
    }
}
