<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use Semaio\TrelloApi\Api\Board\BoardMembershipsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class BoardMembershipsApiTest extends ApiTestCase
{
    protected $apiPath = 'boards/#id#/memberships';

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
        return BoardMembershipsApi::class;
    }
}
