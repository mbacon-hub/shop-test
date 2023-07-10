<?php

namespace App\Services\Interfaces;

use App\Models\CartItem;

interface CartItemStoreInterface
{
    /**
     * @param array $data
     *
     * @return CartItem
     */
    public function store(array $data): CartItem;
}
