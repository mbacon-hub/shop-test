<?php

namespace App\Services\CartItem;

use App\Exceptions\App\Cart\CantAddNotInStockProductToCart;
use App\Models\CartItem;
use App\Models\Product;
use App\Repositories\Interfaces\CartItemRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\CartItemStoreInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartItemStoreService implements CartItemStoreInterface
{
    /**
     * @param ProductRepositoryInterface  $productRepository
     * @param CartItemRepositoryInterface $cartItemRepository
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private CartItemRepositoryInterface $cartItemRepository,
    )
    {
        //
    }

    /**
     * @param array $data
     *
     * @return CartItem
     * @throws CantAddNotInStockProductToCart
     */
    public function store(array $data): CartItem
    {
        $productId = $data['product_id'];
        $userId    = $data['user_id'];

        $product = $this->productRepository->byId($productId);

        if(is_null($productId)) {
            throw new ModelNotFoundException('Not found');
        }

        if($this->productNotInStock($product)) {
            throw new CantAddNotInStockProductToCart();
        }

        return $this->cartItemRepository->store($userId, $product);
    }

    /**
     * @param Product $product
     *
     * @return bool
     */
    private function productNotInStock(Product $product): bool
    {
        return !$product->getRawOriginal('in_stock');
    }
}
