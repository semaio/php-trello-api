<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Member;

use Semaio\TrelloApi\Api\Member\MemberCustomEmojiApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class MemberCustomEmojiApiTest extends ApiTestCase
{
    protected $apiPath = 'members/#id#/customEmoji';

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
        return MemberCustomEmojiApi::class;
    }
}
