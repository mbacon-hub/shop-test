<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    /**
     * @param string $email
     *
     * @return User|Model|null
     */
    public function byEmail(string $email): User|Model|null;

    /**
     * @param int $id
     *
     * @return User|null
     */
    public function byId(int $id): User|null;

    /**
     * @return LengthAwarePaginator
     */
    public function recents(): LengthAwarePaginator;
}
