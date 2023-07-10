<?php

namespace App\Services\Interfaces;

use App\Models\Product;

interface ProductUpdateInterface
{
    /**
     * @param array $data
     *
     * @return Product
     */
    public function update(array $data): Product;
}
