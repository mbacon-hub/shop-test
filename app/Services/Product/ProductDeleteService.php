<?php

namespace App\Services\Product;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\ProductDeleteInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductDeleteService implements ProductDeleteInterface
{
    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository,
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
        $productId = $data['id'];
        $product   = $this->productRepository->byId($productId);

        if (is_null($product)) {
            throw new ModelNotFoundException('Not found');
        }

        $product->delete();
    }
}
