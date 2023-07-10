<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\ProductDeleteInterface;
use App\Services\Interfaces\ProductStoreInterface;
use App\Services\Interfaces\ProductUpdateInterface;
use App\Transformers\Product\ProductIndexTransformer;
use App\Transformers\Product\ProductShowTransformer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @param ProductRepositoryInterface $productRepository
     * @param ProductStoreInterface      $productStoreService
     * @param ProductUpdateInterface     $productUpdateService
     * @param ProductDeleteInterface     $productDeleteService
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ProductStoreInterface      $productStoreService,
        private ProductUpdateInterface     $productUpdateService,
        private ProductDeleteInterface     $productDeleteService,
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

    /**
     * @param ProductStoreRequest $request
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $product = $this->productStoreService->store($data);

        return $this->jsonResponse(
            data: $this->transformItem($product, ProductShowTransformer::class)
        );
    }

    /**
     * @param ProductUpdateRequest $request
     * @param int                  $id
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function update(ProductUpdateRequest $request, int $id): JsonResponse
    {
        $data = [
            ...$request->validated(),
            'id' => $id,
        ];

        $product = $this->productUpdateService->update($data);

        return $this->jsonResponse(
            data: $this->transformItem($product, ProductShowTransformer::class)
        );
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $data = [
            'id' => $id,
        ];

        $this->productDeleteService->delete($data);

        return $this->jsonResponse();
    }
}
