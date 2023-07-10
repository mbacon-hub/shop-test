<?php

namespace App\Repositories\Interfaces;

use App\Data\Category\CategoryData;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    /**
     * @return LengthAwarePaginator<Category|Model>
     */
    public function allPaginated(): LengthAwarePaginator;

    /**
     * @return Collection<Category|Model>
     */
    public function all(): Collection;

    /**
     * @param CategoryData $data
     *
     * @return Category
     */
    public function store(CategoryData $data): Category;

    /**
     * @param Category     $category
     * @param CategoryData $data
     *
     * @return Category
     */
    public function update(Category $category, CategoryData $data): Category;

    /**
     * @param int $id
     *
     * @return Category|Model|null
     */
    public function byId(int $id): Category|Model|null;
}
