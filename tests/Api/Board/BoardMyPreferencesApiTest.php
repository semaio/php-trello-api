<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use Semaio\TrelloApi\Api\Board\BoardMyPreferencesApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class BoardMyPreferencesApiTest extends ApiTestCase
{
    protected $apiPath = 'boards/#id#/myPrefs';

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
        return BoardMyPreferencesApi::class;
    }
}
