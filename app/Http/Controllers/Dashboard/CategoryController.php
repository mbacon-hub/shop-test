<?php

namespace App\Http\Controllers\Dashboard;

use App\Data\Category\CategoryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Interfaces\CategoryDeleteInterface;
use App\Services\Interfaces\CategoryUpdateInterface;
use App\Transformers\Category\CategoryIndexTransformer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryUpdateInterface     $categoryUpdateService
     * @param CategoryDeleteInterface     $categoryDeleteService
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private CategoryUpdateInterface     $categoryUpdateService,
        private CategoryDeleteInterface     $categoryDeleteService,
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
        $categories = $this->categoryRepository->allPaginated();

        return $this->jsonResponse(
            data: $this->transformCollection($categories, CategoryIndexTransformer::class)
        );
    }

    /**
     * @param CategoryStoreRequest $request
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $data = CategoryData::from($request->validated());

        $category = $this->categoryRepository->store($data);

        return $this->jsonResponse(
            data: $this->transformItem($category, CategoryIndexTransformer::class)
        );
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param int                   $id
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse
    {
        $data = [
            ...$request->validated(),
            'id' => $id,
        ];

        $category = $this->categoryUpdateService->update($data);

        return $this->jsonResponse(
            data: $this->transformItem($category, CategoryIndexTransformer::class)
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

        $this->categoryDeleteService->delete($data);

        return $this->jsonResponse();
    }
}
