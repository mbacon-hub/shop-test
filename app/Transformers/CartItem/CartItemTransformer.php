<?php

namespace App\Transformers\CartItem;

use App\Models\CartItem;
use League\Fractal\TransformerAbstract;

class CartItemTransformer extends TransformerAbstract
{

    /**
     * @param CartItem $cartItem
     *
     * @return array
     */
    public function transform(CartItem $cartItem): array
    {
        return [
            'id'    => $cartItem->id,
            'name'  => $cartItem->name,
            'price' => $cartItem->price
        ];
    }
}
