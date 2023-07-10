<?php

namespace App\Transformers\Category;

use App\Models\Category;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class CategoryIndexTransformer extends TransformerAbstract
{
    /**
     * @var array|string[]
     */
    public array $defaultIncludes = [
        'subcategories'
    ];

    /**
     * @param Category $category
     *
     * @return Collection|null
     */
    public function includeSubcategories(Category $category): Collection|null
    {
        if(!$category->relationLoaded('subcategories') || is_null($category->subcategories)) {
            return null;
        }

        return $this->collection($category->subcategories, new CategoryIndexTransformer());
    }

    /**
     * @param Category $category
     *
     * @return array
     */
    public function transform(Category $category): array
    {
        return [
            'id'   => $category->id,
            'name' => $category->name,
        ];
    }
}
