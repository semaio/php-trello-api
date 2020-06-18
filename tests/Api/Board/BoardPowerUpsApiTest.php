<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Board;

use Semaio\TrelloApi\Api\Board\BoardPowerUpsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class BoardPowerUpsApiTest extends ApiTestCase
{
    protected $apiPath = 'boards/#id#/powerUps';

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
        return BoardPowerUpsApi::class;
    }
}
