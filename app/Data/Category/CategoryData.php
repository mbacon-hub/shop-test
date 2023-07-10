<?php

namespace App\Data\Category;

use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    /**
     * @param string   $name
     * @param int|null $parent_id
     */
    public function __construct(
        public string   $name,
        public int|null $parent_id,
    )
    {
        //
    }
}
