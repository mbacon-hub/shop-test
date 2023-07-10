<?php

namespace App\Data\Product;

use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public string      $name,
        public int         $price,
        public string|null $img,
        public string      $description,
        public bool        $in_stock,
    )
    {
        //
    }
}
