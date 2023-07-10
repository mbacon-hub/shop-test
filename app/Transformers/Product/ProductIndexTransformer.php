<?php

namespace App\Transformers\Product;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductIndexTransformer extends TransformerAbstract
{

    /**
     * @param Product $product
     *
     * @return array
     */
    public function transform(Product $product): array
    {
        return [
            'id'       => $product->id,
            'name'     => $product->name,
            'price'    => $product->price,
            'in_stock' => $product->in_stock,
            'img_url'  => $product->img_url,
        ];
    }
}
