<?php

namespace App\Repositories\Eloquent;

use App\Models\CartItem;
use App\Models\Product;
use App\Repositories\Interfaces\CartItemRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CartItemEloquentRepository implements CartItemRepositoryInterface
{

    /**
     * @param int $userId
     *
     * @return Collection
     */
    public function allByUserId(int $userId): Collection
    {
        return CartItem::query()
            ->where('user_id', '=', $userId)
            ->get();
    }

    /**
     * @param int     $userId
     * @param Product $product
     *
     * @return CartItem
     */
    public function store(int $userId, Product $product): CartItem
    {
        $cartItem = new CartItem();

        $cartItem->product_id = $product->id;
        $cartItem->name       = $product->name;
        $cartItem->price      = $product->price;
        $cartItem->user_id    = $userId;

        $cartItem->save();

        return $cartItem;
    }

    /**
     * @param int $id
     * @param int $userId
     *
     * @return CartItem|Model|null
     */
    public function byIdAndUserId(int $id, int $userId): CartItem|Model|null
    {
        return CartItem::query()
            ->where('user_id', '=', $userId)
            ->where('id', '=', $id)
            ->first();
    }
}
