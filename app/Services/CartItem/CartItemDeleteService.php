<?php

namespace App\Services\CartItem;

use App\Repositories\Interfaces\CartItemRepositoryInterface;
use App\Services\Interfaces\CartItemDeleteInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartItemDeleteService implements CartItemDeleteInterface
{
    /**
     * @param CartItemRepositoryInterface $cartItemRepository
     */
    public function __construct(
        private CartItemRepositoryInterface $cartItemRepository,
    )
    {
        //
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function delete(array $data): void
    {
        $cartItemId = $data['cart_item_id'];
        $userId     = $data['user_id'];

        $cartItem = $this->cartItemRepository->byIdAndUserId($cartItemId, $userId);

        if(is_null($cartItem)) {
            throw new ModelNotFoundException('Not found');
        }

        $cartItem->delete();
    }
}
