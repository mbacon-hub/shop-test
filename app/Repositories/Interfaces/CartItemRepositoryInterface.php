<?php

namespace App\Repositories\Interfaces;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CartItemRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return Collection
     */
    public function allByUserId(int $userId): Collection;

    /**
     * @param int     $userId
     * @param Product $product
     *
     * @return CartItem
     */
    public function store(int $userId, Product $product): CartItem;

    /**
     * @param int $id
     * @param int $userId
     *
     * @return CartItem|Model|null
     */
    public function byIdAndUserId(int $id, int $userId): CartItem|Model|null;
}
