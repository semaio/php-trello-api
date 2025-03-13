<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Board\BoardChecklistsApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class BoardChecklistsApiTest extends ApiTestCase
{
    protected string $apiPath = 'boards/#id#/checklists';

    #[Test]
    public function shouldGetAllChecklists(): void
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
    public function shouldCreateChecklist(): void
    {
        $data = [
            'name' => 'Test Checklist',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($data);

        static::assertEquals($data, $api->create($this->fakeParentId, $data));
    }

    #[Test]
    public function shouldNotCreateChecklistWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($this->fakeParentId, $data);
    }

    protected function getApiClass(): string
    {
        return BoardChecklistsApi::class;
    }
}
