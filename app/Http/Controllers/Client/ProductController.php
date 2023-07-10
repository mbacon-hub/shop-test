<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Transformers\Product\ProductIndexTransformer;
use App\Transformers\Product\ProductShowTransformer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
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
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function index(): JsonResponse
    {
        $products = $this->productRepository->allPaginated();

        return $this->jsonResponse(
            data: $this->transformCollection($products, ProductIndexTransformer::class)
        );
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->productRepository->byId($id);

        if(is_null($product)) {
            throw new ModelNotFoundException('Not found');
        }

        return $this->jsonResponse(
            data: $this->transformItem($product, ProductShowTransformer::class)
        );
    }
}
