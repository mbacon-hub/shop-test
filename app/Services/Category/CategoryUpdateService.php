<?php

namespace App\Services\Category;

use App\Data\Category\CategoryData;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Interfaces\CategoryUpdateInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryUpdateService implements CategoryUpdateInterface
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

    public function update(array $data): Category
    {
        $categoryData = CategoryData::from($data);
        $categoryId   = $data['id'];

        $category = $this->categoryRepository->byId($categoryId);

        if(is_null($category)) {
            throw new ModelNotFoundException('Not found');
        }

        return $this->categoryRepository->update($category, $categoryData);
    }
}
