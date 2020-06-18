<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use Semaio\TrelloApi\Api\Card\CardActionsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class CardActionsApiTest extends ApiTestCase
{
    protected $apiPath = 'cards/#id#/actions';

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
    public function shouldAddComment(): void
    {
        $response = ['response'];

        $text = 'Comment text';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->getPath().'/comments')
            ->willReturn($response);

        static::assertEquals($response, $api->addComment($this->fakeParentId, $text));
    }

    /**
     * @test
     */
    public function shouldRemoveComment(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->getPath().'/'.$this->fakeId.'/comments')
            ->willReturn($response);

        static::assertEquals($response, $api->removeComment($this->fakeParentId, $this->fakeId));
    }

    protected function getApiClass()
    {
        return CardActionsApi::class;
    }
}
