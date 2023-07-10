<?php

namespace App\Services\Interfaces;

interface ProductDeleteInterface
{
    /**
     * @param array $data
     *
     * @return void
     */
    public function delete(array $data): void;
}
