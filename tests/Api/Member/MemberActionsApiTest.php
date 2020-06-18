<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Member;

use Semaio\TrelloApi\Api\Member\MemberActionsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class MemberActionsApiTest extends ApiTestCase
{
    protected $apiPath = 'members/#id#/actions';

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

    protected function getApiClass()
    {
        return MemberActionsApi::class;
    }
}
