<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Member;

use Semaio\TrelloApi\Api\Member\MemberSavedSearchesApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class MemberSavedSearchesApiTest extends ApiTestCase
{
    protected $apiPath = 'members/#id#/saveSearches';

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
        return MemberSavedSearchesApi::class;
    }
}
