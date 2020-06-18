<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Fake;

use Semaio\TrelloApi\Api\AbstractApi;

class AbstractApiFake extends AbstractApi
{
    public function testTransformParameters(array $parameters): array
    {
        return $this->transformParameters($parameters);
    }
}
