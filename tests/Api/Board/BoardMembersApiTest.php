<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Board\BoardMembersApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class BoardMembersApiTest extends ApiTestCase
{
    protected string $apiPath = 'boards/#id#/members';

    #[Test]
    public function shouldGetAllMembers(): void
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
    public function shouldRemoveMember(): void
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
    public function shouldInviteMember(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->invite($this->fakeParentId, 'john@doe.com', 'John Doe', 'normal'));
    }

    #[Test]
    public function shouldNotInviteMemberWithUnexistingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects($this->never())->method('put');

        $api->invite($this->fakeParentId, 'john@doe.com', 'John Doe', 'unexisting');
    }

    #[Test]
    public function shouldGetMemberCards(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId.'/cards')
            ->willReturn($response);

        static::assertEquals($response, $api->cards($this->fakeParentId, $this->fakeId));
    }

    #[Test]
    public function shouldFilterMembersWithDefaultFilter(): void
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
    public function shouldFilterMembersWithStringArgument(): void
    {
        $response = ['response'];

        $filter = 'admins';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/admins')
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId, $filter));
    }

    #[Test]
    public function shouldFilterMembersWithArrayArgument(): void
    {
        $response = ['response'];

        $filter = ['admins', 'owners'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/admins,owners')
            ->willReturn($response);

        static::assertEquals($response, $api->filters($this->fakeParentId, $filter));
    }

    #[Test]
    public function shouldGetInvitedMembers(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited')
            ->willReturn($response);

        static::assertEquals($response, $api->getInvitedMembers($this->fakeParentId));
    }

    #[Test]
    public function shouldGetInvitedMembersField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'Invited/bio')
            ->willReturn($response);

        static::assertEquals($response, $api->getInvitedMembersField($this->fakeParentId, 'bio'));
    }

    #[Test]
    public function shouldNotGetUnexistingInvitedMembersField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects($this->never())->method('get');

        $api->getInvitedMembersField($this->fakeParentId, 'unexisting');
    }

    #[Test]
    public function shouldSetRole(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->setRole($this->fakeParentId, $this->fakeId, 'normal'));
    }

    #[Test]
    public function shouldNotSetUnexistingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects($this->never())->method('post');

        $api->setRole($this->fakeParentId, $this->fakeId, 'unexisting');
    }

    protected function getApiClass(): string
    {
        return BoardMembersApi::class;
    }
}
