<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use Semaio\TrelloApi\Api\Board\BoardMembersApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class BoardMembersApiTest extends ApiTestCase
{
    protected $apiPath = 'boards/#id#/members';

    /**
     * @test
     */
    public function shouldGetAllMembers(): void
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
    public function shouldRemoveMember(): void
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
    public function shouldInviteMember(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->invite($this->fakeParentId, 'john@doe.com', 'John Doe', 'normal'));
    }

    /**
     * @test
     */
    public function shouldNotInviteMemberWithUnexistingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('put');

        $api->invite($this->fakeParentId, 'john@doe.com', 'John Doe', 'unexisting');
    }

    /**
     * @test
     */
    public function shouldGetMemberCards(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/'.$this->fakeId.'/cards')
            ->willReturn($response);

        static::assertEquals($response, $api->cards($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldFilterMembersWithDefaultFilter(): void
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
    public function shouldFilterMembersWithStringArgument(): void
    {
        $response = ['response'];

        $filter = 'admins';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/admins')
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldFilterMembersWithArrayArgument(): void
    {
        $response = ['response'];

        $filter = ['admins', 'owners'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'/admins,owners')
            ->willReturn($response);

        static::assertEquals($response, $api->filters($this->fakeParentId, $filter));
    }

    /**
     * @test
     */
    public function shouldGetInvitedMembers(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'Invited')
            ->willReturn($response);

        static::assertEquals($response, $api->getInvitedMembers($this->fakeParentId));
    }

    /**
     * @test
     */
    public function shouldGetInvitedMembersField(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'Invited/bio')
            ->willReturn($response);

        static::assertEquals($response, $api->getInvitedMembersField($this->fakeParentId, 'bio'));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingInvitedMembersField(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->getInvitedMembersField($this->fakeParentId, 'unexisting');
    }

    /**
     * @test
     */
    public function shouldSetRole(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath().'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->setRole($this->fakeParentId, $this->fakeId, 'normal'));
    }

    /**
     * @test
     */
    public function shouldNotSetUnexistingRole(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->setRole($this->fakeParentId, $this->fakeId, 'unexisting');
    }

    protected function getApiClass()
    {
        return BoardMembersApi::class;
    }
}
