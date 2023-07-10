<?php

namespace App\Transformers\Auth;

use Laravel\Sanctum\NewAccessToken;
use League\Fractal\TransformerAbstract;

class AccessTokenTransformer extends TransformerAbstract
{
    /**
     * @param NewAccessToken $token
     *
     * @return array
     */
    public function transform(NewAccessToken $token): array
    {
        return [
            'token'      => $token->plainTextToken,
            'expires_at' => $token->accessToken->expires_at,
            'abilities'  => $token->accessToken->abilities,
            'created_at' => $token->accessToken->created_at,
        ];
    }
}
