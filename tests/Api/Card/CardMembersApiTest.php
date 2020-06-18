<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use Semaio\TrelloApi\Api\Card\CardMembersApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class CardMembersApiTest extends ApiTestCase
{
    protected $apiPath = 'cards/#id#/members';

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
    public function shouldSetMembers(): void
    {
        $data = [
            $this->fakeId('member1'),
            $this->fakeId('member2'),
            $this->fakeId('member3'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->getPath())
            ->willReturn($data);

        static::assertEquals($data, $api->set($this->fakeParentId, $data));
    }

    /**
     * @test
     */
    public function shouldNotSetMembersWithEmptyArray(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('put');

        $api->set($this->fakeParentId, $data);
    }

    /**
     * @test
     */
    public function shouldAddMember(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->add($this->fakeParentId, $this->fakeId));
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
    public function shouldAddVote(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath().'/membersVoted')
            ->willReturn($response);

        static::assertEquals($response, $api->addVote($this->fakeParentId, $this->fakeId));
    }

    /**
     * @test
     */
    public function shouldRemoveVote(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->getPath().'/membersVoted/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->removeVote($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass()
    {
        return CardMembersApi::class;
    }
}
