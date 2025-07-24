<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidStatusException extends Exception
{
    public function __construct(string $message = "Status ID tidak valid.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
