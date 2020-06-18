<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Member\Board;

use Semaio\TrelloApi\Api\Member\Board\MemberBoardBackgroundsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class MemberBoardBackgroundsApiTest extends ApiTestCase
{
    protected $apiPath = 'members/#id#/boardBackgrounds';

    /**
     * @test
     */
    public function notImplementedYet(): void
    {
        static::markTestSkipped(
            sprintf('The "%s" API is not implemented yet.', $this->getApiClass())
        );
    }

    protected function getApiClass()
    {
        return MemberBoardBackgroundsApi::class;
    }
}
