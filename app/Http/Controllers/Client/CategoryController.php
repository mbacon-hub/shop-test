<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Transformers\Category\CategoryIndexTransformer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
    )
    {
        //
    }

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function list(): JsonResponse
    {
        $categories = $this->categoryRepository->all();

        return $this->jsonResponse(
            data: $this->transformCollection($categories, CategoryIndexTransformer::class)
        );
    }
}
