<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Configuration;

use Semaio\TrelloApi\Exception\InvalidApiVersionException;

/**
 * Class Configuration.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $baseUri = 'https://api.trello.com/%s';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var int
     */
    private $apiVersion;

    /**
     * Configuration constructor.
     */
    public function __construct(string $apiKey, string $apiToken, int $apiVersion = 1)
    {
        $this->apiKey = $apiKey;
        $this->apiToken = $apiToken;

        if (!in_array($apiVersion, static::SUPPORTED_API_VERSIONS, true)) {
            throw new InvalidApiVersionException(sprintf('Invalid api version "%s".', $apiVersion));
        }
        $this->apiVersion = $apiVersion;
    }

    public static function create(string $apiKey, string $apiToken, int $apiVersion = 1): ConfigurationInterface
    {
        return new static($apiKey, $apiToken, $apiVersion);
    }

    public function getBaseUri(): string
    {
        return sprintf($this->baseUri, $this->apiVersion);
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }
}
