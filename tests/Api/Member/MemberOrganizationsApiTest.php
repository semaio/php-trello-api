<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Member;

use Semaio\TrelloApi\Api\Member\MemberOrganizationsApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class MemberOrganizationsApiTest extends ApiTestCase
{
    protected $apiPath = 'members/#id#/organizations';

    /**
     * @test
     */
    public function shouldGetAllOrganizations(): void
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
    public function shouldFilterOrganizationsWithDefaultFilter(): void
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
    public function shouldFilterOrganizationsWithStringArgument(): void
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
    public function shouldFilterOrganizationsWithArrayArgument(): void
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

    /**
     * @test
     */
    public function shouldGetOrganizationsAMemberIsInvitedTo(): void
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
    public function shouldGetFieldOfAnOrganizationAMemberIsInvitedTo(): void
    {
        $response = ['response'];

        $field = 'desc';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->getPath().'Invited/desc')
            ->willReturn($response);

        static::assertEquals($response, $api->invitedToField($this->fakeParentId, $field));
    }

    /**
     * @test
     */
    public function shouldNotGetUnexistingFieldOfAnOrganizationAMemberIsInvitedTo(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $field = 'unexisting';

        $api = $this->getApiMock();
        $api->expects(static::never())->method('get');

        $api->invitedToField($this->fakeParentId, $field);
    }

    protected function getApiClass()
    {
        return MemberOrganizationsApi::class;
    }
}
