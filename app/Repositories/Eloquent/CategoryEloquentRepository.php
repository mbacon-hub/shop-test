<?php

namespace App\Repositories\Eloquent;

use App\Data\Category\CategoryData;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoryEloquentRepository implements CategoryRepositoryInterface
{

    /**
     * @return LengthAwarePaginator<Category|Model>
     */
    public function allPaginated(): LengthAwarePaginator
    {
        return Category::query()
            ->with(['subcategories'])
            ->whereNull('parent_id')
            ->paginate();
    }

    /**
     * @param CategoryData $data
     *
     * @return Category
     */
    public function store(CategoryData $data): Category
    {
        $category = new Category();

        $category->name      = $data->name;
        $category->parent_id = $data->parent_id;

        $category->save();

        return $category;
    }

    /**
     * @param Category     $category
     * @param CategoryData $data
     *
     * @return Category
     */
    public function update(Category $category, CategoryData $data): Category
    {
        $category->name      = $data->name;

        $category->save();

        return $category;
    }

    /**
     * @param int $id
     *
     * @return Category|Model|null
     */
    public function byId(int $id): Category|Model|null
    {
        return Category::query()
            ->where('id', '=', $id)
            ->first();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Category::query()
            ->with(['subcategories'])
            ->whereNull('parent_id')
            ->get();
    }
}
