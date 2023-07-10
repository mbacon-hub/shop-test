<?php

namespace App\Services\Interfaces;

use App\Models\Category;

interface CategoryUpdateInterface
{

    /**
     * @param array $data
     *
     * @return Category
     */
    public function update(array $data): Category;
}
