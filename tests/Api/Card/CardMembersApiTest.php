<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Card\CardMembersApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class CardMembersApiTest extends ApiTestCase
{
    protected string $apiPath = 'cards/#id#/members';

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
    public function shouldSetMembers(): void
    {
        $data = [
            $this->fakeId('member1'),
            $this->fakeId('member2'),
            $this->fakeId('member3'),
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath())
            ->willReturn($data);

        static::assertEquals($data, $api->set($this->fakeParentId, $data));
    }

    #[Test]
    public function shouldNotSetMembersWithEmptyArray(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $data = [];

        $api = $this->getApiMock();
        $api->expects($this->never())->method('put');

        $api->set($this->fakeParentId, $data);
    }

    #[Test]
    public function shouldAddMember(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath())
            ->willReturn($response);

        static::assertEquals($response, $api->add($this->fakeParentId, $this->fakeId));
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
    public function shouldAddVote(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/membersVoted')
            ->willReturn($response);

        static::assertEquals($response, $api->addVote($this->fakeParentId, $this->fakeId));
    }

    #[Test]
    public function shouldRemoveVote(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/membersVoted/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->removeVote($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass(): string
    {
        return CardMembersApi::class;
    }
}
