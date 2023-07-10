<?php

namespace App\Services\Interfaces;

interface CategoryDeleteInterface
{

    /**
     * @param array $data
     *
     * @return void
     */
    public function delete(array $data): void;
}
