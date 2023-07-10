<?php

namespace App\Services\Interfaces;

interface CartItemDeleteInterface
{
    /**
     * @param array $data
     *
     * @return void
     */
    public function delete(array $data): void;
}
