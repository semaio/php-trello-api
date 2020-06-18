<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Organization;

use Semaio\TrelloApi\Api\Organization\OrganizationBoardsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

class OrganizationBoardsApiTest extends ApiTestCase
{
    protected $apiPath = 'organization/#id#/boards';

    /**
     * @test
     */
    public function shouldGetAllActions(): void
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
    public function shouldFilterOrganizationBoardsWithDefaultFilter(): void
    {
        $response = ['response'];

        $defaultFilter = 'all';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/'.$defaultFilter)
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldFilterOrganizationBoardssWithStringArgument(): void
    {
        $response = ['response'];

        $filter = 'members';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/members')
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldFilterOrganizationBoardsWithArrayArgument(): void
    {
        $response = ['response'];

        $filter = ['members', 'public'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/members,public')
            ->willReturn($response);

        static::assertEquals($response, $api->filters($this->fakeParentId, $filter));
    }

    protected function getApiClass()
    {
        return OrganizationBoardsApi::class;
    }
}
