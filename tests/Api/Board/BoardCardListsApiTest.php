<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Board\BoardCardListsApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class BoardCardListsApiTest extends ApiTestCase
{
    protected string $apiPath = 'boards/#id#/lists';

    #[Test]
    public function shouldGetAllCardLists(): void
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
    public function shouldFilterCardListsWithDefaultFilter(): void
    {
        $response = ['response'];

        $defaultFilter = 'all';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$defaultFilter)
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId));
    }

    #[Test]
    public function shouldFilterCardListsWithStringArgument(): void
    {
        $response = ['response'];

        $filter = 'open';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/open')
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId, $filter));
    }

    #[Test]
    public function shouldFilterCardListsWithArrayArgument(): void
    {
        $response = ['response'];

        $filter = ['open', 'closed'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/open,closed')
            ->willReturn($response);

        static::assertEquals($response, $api->filters($this->fakeParentId, $filter));
    }

    #[Test]
    public function shouldCreateCardlist(): void
    {
        $data = [
            'name' => 'Test list',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($data);

        static::assertEquals($data, $api->create($this->fakeParentId, $data));
    }

    #[Test]
    public function shouldNotCreateCardlistWithoutName(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = [
            'desc' => 'Test description',
        ];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->create($this->fakeParentId, $data);
    }

    protected function getApiClass(): string
    {
        return BoardCardListsApi::class;
    }
}
