<?php

namespace App\Exceptions\App\Cart;

use App\Exceptions\App\AppException;
use Throwable;

class CantAddNotInStockProductToCart extends AppException
{
    /**
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "Given product not in stock", int $code = 500, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
