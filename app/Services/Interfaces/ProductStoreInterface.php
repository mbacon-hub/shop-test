<?php

namespace App\Services\Interfaces;

use App\Models\Product;

interface ProductStoreInterface
{
    /**
     * @param array $data
     *
     * @return Product
     */
    public function store(array $data): Product;
}
