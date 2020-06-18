<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Member;

use Semaio\TrelloApi\Api\Member\MemberCustomStickersApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class MemberCustomStickersApiTest extends ApiTestCase
{
    protected $apiPath = 'members/#id#/customStickers';

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
        return MemberCustomStickersApi::class;
    }
}
