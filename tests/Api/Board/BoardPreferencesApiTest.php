<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use Semaio\TrelloApi\Api\Board\BoardPreferencesApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class BoardPreferencesApiTest extends ApiTestCase
{
    protected $apiPath = 'boards/#id#/prefs';

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
        return BoardPreferencesApi::class;
    }
}
