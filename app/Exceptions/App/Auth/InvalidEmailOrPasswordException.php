<?php

namespace App\Exceptions\App\Auth;

use App\Exceptions\App\AppException;
use Throwable;

class InvalidEmailOrPasswordException extends AppException
{
    /**
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "Email or password invalid", int $code = 400, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
