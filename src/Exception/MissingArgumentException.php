<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Exception;

class MissingArgumentException extends ErrorException
{
    public function __construct(string $required = '', $code = 0, $severity = 1, $filename = __FILE__, $lineno = __LINE__, $previous = null)
    {
        if (is_string($required)) {
            $required = [$required];
        }

        parent::__construct(sprintf('One or more of required ("%s") parameters are missing!', implode('", "', $required)), $code, $severity, $filename, $lineno, $previous);
    }
}
