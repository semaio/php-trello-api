<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Routing;

/**
 * Class UriGeneratorInterface.
 */
interface UriGeneratorInterface
{
    /**
     * Generate the uri string.
     */
    public function generate(string $path, array $queryParameters = []): string;
}
