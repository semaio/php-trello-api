<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Member;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Member\MemberNotificationsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class MemberNotificationsApiTest extends ApiTestCase
{
    protected string $apiPath = 'members/#id#/notifications';

    #[Test]
    public function shouldGetAllNotifications(): void
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
    public function shouldFilterNotificationsWithDefaultFilter(): void
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
    public function shouldFilterNotificationsWithStringArgument(): void
    {
        $response = ['response'];

        $filter = 'createCard';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/createCard')
            ->willReturn($response);

        static::assertEquals($response, $api->filter($this->fakeParentId, $filter));
    }

    #[Test]
    public function shouldFilterNotificationsWithArrayArgument(): void
    {
        $response = ['response'];

        $filter = ['createCard', 'updateCard'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with($this->getPath().'/createCard,updateCard')
            ->willReturn($response);

        static::assertEquals($response, $api->filters($this->fakeParentId, $filter));
    }

    protected function getApiClass(): string
    {
        return MemberNotificationsApi::class;
    }
}
