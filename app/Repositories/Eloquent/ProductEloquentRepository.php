<?php

namespace App\Repositories\Eloquent;

use App\Data\Product\ProductData;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class ProductEloquentRepository implements ProductRepositoryInterface
{

    /**
     * @return LengthAwarePaginator
     */
    public function allPaginated(): LengthAwarePaginator
    {
        return Product::query()
            ->paginate();
    }

    /**
     * @param ProductData $data
     *
     * @return Product
     */
    public function store(ProductData $data): Product
    {
        $product = new Product();

        $product->name        = $data->name;
        $product->price       = $data->price;
        $product->description = $data->description;
        $product->in_stock    = $data->in_stock;
        $product->img         = $data->img;

        $product->save();

        return $product;
    }

    /**
     * @param int $id
     *
     * @return Product|Model|null
     */
    public function byId(int $id): Product|Model|null
    {
        return Product::query()
            ->where('id', '=', $id)
            ->first();
    }

    public function update(Model|Product $product, ProductData $data): Product|Model
    {
        $product->name        = $data->name;
        $product->price       = $data->price;
        $product->description = $data->description;
        $product->in_stock    = $data->in_stock;
        $product->img         = $data->img ?? $product->img;

        $product->save();

        return $product;
    }
}
