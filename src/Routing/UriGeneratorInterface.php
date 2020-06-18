<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Routing;

/**
 * Class UriGeneratorInterface.
 */
interface UriGeneratorInterface
{
    public function generate(string $path, array $queryParameters = []): string;
}
