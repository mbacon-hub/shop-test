<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartItemStoreRequest;
use App\Repositories\Interfaces\CartItemRepositoryInterface;
use App\Services\Interfaces\CartItemDeleteInterface;
use App\Services\Interfaces\CartItemStoreInterface;
use App\Transformers\CartItem\CartItemTransformer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @param CartItemRepositoryInterface $cartItemRepository
     * @param CartItemStoreInterface      $cartItemStoreService
     * @param CartItemDeleteInterface     $cartItemDeleteService
     */
    public function __construct(
        private CartItemRepositoryInterface $cartItemRepository,
        private CartItemStoreInterface      $cartItemStoreService,
        private CartItemDeleteInterface     $cartItemDeleteService,
    )
    {
        //
    }

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function index(): JsonResponse
    {
        $cartItems = $this->cartItemRepository->allByUserId(Auth::id());

        return $this->jsonResponse(
            data: $this->transformCollection($cartItems, CartItemTransformer::class)
        );
    }

    /**
     * @param CartItemStoreRequest $request
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function store(CartItemStoreRequest $request): JsonResponse
    {
        $data = [
            ...$request->validated(),
            'user_id' => Auth::id(),
        ];

        $cartItem = $this->cartItemStoreService->store($data);

        return $this->jsonResponse(
            data: $this->transformItem($cartItem, CartItemTransformer::class)
        );
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $data = [
            'cart_item_id' => $id,
            'user_id' => Auth::id(),
        ];

        $this->cartItemDeleteService->delete($data);

        return $this->jsonResponse();
    }
}
