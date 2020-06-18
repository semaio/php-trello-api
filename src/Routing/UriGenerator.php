<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Routing;

use Semaio\TrelloApi\Configuration\ConfigurationInterface;

/**
 * Class UriGenerator.
 */
class UriGenerator implements UriGeneratorInterface
{
    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * UriGenerator constructor.
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public static function create(ConfigurationInterface $configuration): UriGeneratorInterface
    {
        return new self($configuration);
    }

    /**
     * {@inheritdoc}
     */
    public function generate(string $path, array $queryParameters = []): string
    {
        $uri = $this->configuration->getBaseUri().'/'.ltrim($path, '/');

        // Add authentication query parameters
        $queryParameters['key'] = $this->configuration->getApiKey();
        $queryParameters['token'] = $this->configuration->getApiToken();

        // Add query parameters
        $uri .= '?'.http_build_query($queryParameters, '', '&', PHP_QUERY_RFC3986);

        return $uri;
    }
}
