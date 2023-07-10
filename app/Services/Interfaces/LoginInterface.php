<?php

namespace App\Services\Interfaces;

use App\Exceptions\App\Auth\InvalidEmailOrPasswordException;
use Laravel\Sanctum\NewAccessToken;

interface LoginInterface
{
    /**
     * @param array $data
     *
     * @return NewAccessToken
     * @throws InvalidEmailOrPasswordException
     */
    public function login(array $data): NewAccessToken;
}
