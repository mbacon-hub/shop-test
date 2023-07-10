<?php

namespace App\Repositories\Interfaces;

use App\Data\Product\ProductData;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    /**
     * @return LengthAwarePaginator<Product|Model>
     */
    public function allPaginated(): LengthAwarePaginator;

    /**
     * @param ProductData $data
     *
     * @return Product
     */
    public function store(ProductData $data): Product;

    /**
     * @param int $id
     *
     * @return Product|Model|null
     */
    public function byId(int $id): Product|Model|null;

    /**
     * @param Product|Model $product
     * @param ProductData   $data
     *
     * @return Product|Model
     */
    public function update(Product|Model $product, ProductData $data): Product|Model;
}
