<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Interfaces\CategoryDeleteInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryDeleteService implements CategoryDeleteInterface
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
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
        $categoryId = $data['id'];

        $category = $this->categoryRepository->byId($categoryId);

        if(is_null($category)) {
            throw new ModelNotFoundException('Not found');
        }

        $category->delete();
   }
}
