<?php

namespace App\Exceptions\App\Product;

use App\Exceptions\App\AppException;
use Throwable;

class ProductUploadFileFailed extends AppException
{
    /**
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "File upload failed", int $code = 500, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
