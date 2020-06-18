<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Member;

use Semaio\TrelloApi\Api\Member\Board\MemberBoardBackgroundsApi;
use Semaio\TrelloApi\Api\Member\Board\MemberBoardStarsApi;
use Semaio\TrelloApi\Api\Member\MemberBoardsApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class MemberBoardsApiTest extends ApiTestCase
{
    protected $apiPath = 'members/#id#/boards';

    /**
     * @test
     */
    public function shouldGetAllBoards(): void
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
    public function shouldFilterBoardsWithDefaultFilter(): void
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
    public function shouldFilterBoardsWithStringArgument(): void
    {
        $response = ['response'];

        $filter = 'open';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/open')
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldFilterBoardsWithArrayArgument(): void
    {
        $response = ['response'];

        $filter = ['open', 'closed'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/open,closed')
            ->willReturn($response);

        static::assertEquals($response, $api->filters($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldGetInvitedTo(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'Invited')
            ->willReturn($response);

        static::assertEquals($response, $api->invitedTo($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetInvitedToField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'Invited/name')
            ->willReturn($response);

        static::assertEquals($response, $api->invitedToField($this->fakeParentId, 'name'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingInvitedToField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->invitedToField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldPinBoard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with('members/'.$this->fakeParentId.'/idBoardsPinned')
            ->willReturn($response);

        static::assertEquals($response, $api->pin($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldUnpinBoard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with('members/'.$this->fakeParentId.'/idBoardsPinned/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->unpin($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldGetBackgroundsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardBackgroundsApi::class, $this->getApiMock()->backgrounds());
    }

    /**
     * @test
     */
    public function shouldGetStarsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardStarsApi::class, $this->getApiMock()->stars());
    }

    protected function getApiClass()
    {
        return MemberBoardsApi::class;
    }
}
