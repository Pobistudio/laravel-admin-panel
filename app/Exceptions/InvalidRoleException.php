<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidRoleException extends Exception
{
    public function __construct(string $message = "Invalid role provided.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
