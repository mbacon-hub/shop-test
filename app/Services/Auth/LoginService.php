<?php

namespace App\Services\Auth;

use App\Exceptions\App\Auth\InvalidEmailOrPasswordException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\LoginInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class LoginService implements LoginInterface
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
    )
    {
        //
    }

    /**
     * @param array $data
     *
     * @return NewAccessToken
     * @throws InvalidEmailOrPasswordException
     */
    public function login(array $data): NewAccessToken
    {
        $user = $this->userRepository->byEmail($data['email']);

        $this->validate($user, $data);

        return $user->createToken('');
    }

    /**
     * @param User|Model|null $user
     * @param array           $data
     *
     * @return void
     * @throws InvalidEmailOrPasswordException
     */
    private function validate(User|Model|null $user, array $data): void
    {
        if (is_null($user)) {
            throw new InvalidEmailOrPasswordException();
        }

        if ($this->checkPasswordHashMismatch($data['password'], $user->password)) {
            throw new InvalidEmailOrPasswordException();
        }
    }

    /**
     * @param string $password
     * @param string $hashed
     *
     * @return bool
     */
    private function checkPasswordHashMismatch(string $password, string $hashed): bool
    {
        return !Hash::check($password, $hashed);
    }
}
