<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserEloquentRepository implements UserRepositoryInterface
{

    /**
     * @param string $email
     *
     * @return User|Model|null
     */
    public function byEmail(string $email): User|Model|null
    {
        return User::query()
            ->where('email', '=', $email)
            ->first();
    }

    /**
     * @param int $id
     *
     * @return User|null
     */
    public function byId(int $id): User|null
    {
        return User::query()
            ->where('id', '=', $id)
            ->first();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function recents(): LengthAwarePaginator
    {
        return User::query()
            ->withCount('posts')
            ->orderByDesc('posts_count')
            ->with([
                'posts' => fn(HasMany $q) => $q->limit(3)
            ])
            ->paginate();
    }
}
