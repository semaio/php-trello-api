<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Checklist;

use Semaio\TrelloApi\Api\Checklist\ChecklistCardsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class ChecklistCardsApiTest extends ApiTestCase
{
    protected $apiPath = 'checklists/#id#/cards';

    /**
     * @test
     */
    public function shouldGetAllCards(): void
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
    public function shouldFilterCardsWithDefaultFilter(): void
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
    public function shouldFilterCardsWithStringArgument(): void
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
    public function shouldFilterCardsWithArrayArgument(): void
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

    protected function getApiClass()
    {
        return ChecklistCardsApi::class;
    }
}
