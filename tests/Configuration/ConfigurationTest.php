<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Semaio\TrelloApi\Configuration\Configuration;
use Semaio\TrelloApi\Exception\InvalidApiVersionException;

/**
 * Class ConfigurationTest.
 */
class ConfigurationTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_build_configuration_object(): void
    {
        $baseUri = 'https://api.trello.com/1';
        $apiKey = 'KEY';
        $apiToken = 'TOKEN';
        $configuration = Configuration::create($apiKey, $apiToken);

        static::assertEquals($baseUri, $configuration->getBaseUri());
        static::assertEquals($apiKey, $configuration->getApiKey());
        static::assertEquals($apiToken, $configuration->getApiToken());
    }

    /**
     * @test
     */
    public function it_can_not_use_invalid_api_version(): void
    {
        $this->expectException(InvalidApiVersionException::class);

        Configuration::create('KEY', 'TOKEN', 2);
    }
}
