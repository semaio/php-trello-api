<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Card\CardActionsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class CardActionsApiTest extends ApiTestCase
{
    protected string $apiPath = 'cards/#id#/actions';

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
    public function shouldAddComment(): void
    {
        $response = ['response'];

        $text = 'Comment text';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with($this->getPath().'/comments')
            ->willReturn($response);

        static::assertEquals($response, $api->addComment($this->fakeParentId, $text));
    }

    #[Test]
    public function shouldUpdateComment(): void
    {
        $response = ['response'];

        $text = 'Comment text updated';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath().'/'.$this->fakeId.'/comments')
            ->willReturn($response);

        static::assertEquals($response, $api->updateComment($this->fakeParentId, $this->fakeId, $text));
    }

    #[Test]
    public function shouldRemoveComment(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId.'/comments')
            ->willReturn($response);

        static::assertEquals($response, $api->removeComment($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass(): string
    {
        return CardActionsApi::class;
    }
}
