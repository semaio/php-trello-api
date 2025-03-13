<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Member;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Member\Board\MemberBoardBackgroundsApi;
use Semaio\TrelloApi\Api\Member\Board\MemberBoardStarsApi;
use Semaio\TrelloApi\Api\Member\MemberBoardsApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class MemberBoardsApiTest extends ApiTestCase
{
    protected string $apiPath = 'members/#id#/boards';

    #[Test]
    public function shouldGetAllBoards(): void
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
    public function shouldFilterBoardsWithDefaultFilter(): void
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
    public function shouldFilterBoardsWithStringArgument(): void
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
    public function shouldFilterBoardsWithArrayArgument(): void
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
    public function shouldGetInvitedTo(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited')
            ->willReturn($response);

        static::assertEquals($response, $api->invitedTo($this->fakeParentId));
    }

    #[Test]
    public function shouldGetInvitedToField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited/name')
            ->willReturn($response);

        static::assertEquals($response, $api->invitedToField($this->fakeParentId, 'name'));
    }

    #[Test]
    public function shouldNotGetUnexistingInvitedToField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects($this->never())->method('get');

        $api->invitedToField($this->fakeParentId, 'unexisting');
    }

    #[Test]
    public function shouldPinBoard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('members/'.$this->fakeParentId.'/idBoardsPinned')
            ->willReturn($response);

        static::assertEquals($response, $api->pin($this->fakeParentId, $this->fakeId));
    }

    #[Test]
    public function shouldUnpinBoard(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with('members/'.$this->fakeParentId.'/idBoardsPinned/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->unpin($this->fakeParentId, $this->fakeId));
    }

    #[Test]
    public function shouldGetBackgroundsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardBackgroundsApi::class, $this->getApiMock()->backgrounds());
    }

    #[Test]
    public function shouldGetStarsApiObject(): void
    {
        static::assertInstanceOf(MemberBoardStarsApi::class, $this->getApiMock()->stars());
    }

    protected function getApiClass(): string
    {
        return MemberBoardsApi::class;
    }
}
