<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Exception;

class ApiLimitExceedException extends \InvalidArgumentException implements ExceptionInterface
{
}
