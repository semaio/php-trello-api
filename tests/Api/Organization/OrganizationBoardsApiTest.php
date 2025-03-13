<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Organization;

use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Organization\OrganizationBoardsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

class OrganizationBoardsApiTest extends ApiTestCase
{
    protected string $apiPath = 'organization/#id#/boards';

    #[Test]
    public function shouldGetAllActions(): void
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
    public function shouldFilterOrganizationBoardsWithDefaultFilter(): void
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
    public function shouldFilterOrganizationBoardssWithStringArgument(): void
    {
        $response = ['response'];

        $filter = 'members';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/members')
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId, $filter));
    }

    #[Test]
    public function shouldFilterOrganizationBoardsWithArrayArgument(): void
    {
        $response = ['response'];

        $filter = ['members', 'public'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/members,public')
            ->willReturn($response);

        static::assertEquals($response, $api->filters($this->fakeParentId, $filter));
    }

    protected function getApiClass(): string
    {
        return OrganizationBoardsApi::class;
    }
}
