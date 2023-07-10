<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\App\Auth\InvalidEmailOrPasswordException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Interfaces\LoginInterface;
use App\Transformers\Auth\AccessTokenTransformer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @param LoginInterface $loginService
     */
    public function __construct(
        private LoginInterface $loginService,
    )
    {
        //
    }

    /**
     * @param LoginRequest $loginRequest
     *
     * @return JsonResponse
     * @throws InvalidEmailOrPasswordException
     * @throws BindingResolutionException
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $data = $loginRequest->validated();

        $token = $this->loginService->login($data);

        return $this->jsonResponse(
            data: $this->transformItem($token, AccessTokenTransformer::class)
        );
    }
}
