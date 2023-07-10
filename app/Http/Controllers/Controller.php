<?php

namespace App\Http\Controllers;

use ArrayAccess;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param string $message
     * @param array  $data
     * @param int    $code
     *
     * @return JsonResponse
     */
    public function jsonResponse(string $message = 'success', array $data = [], int $code = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    /**
     * @param mixed  $item
     * @param string $transformerClass
     *
     * @return array
     * @throws BindingResolutionException
     */
    public function transformItem(mixed $item, string $transformerClass): array
    {
        /** @var Manager $fractal */
        $fractal  = app()->make(Manager::class);
        $resource = new Item($item, new $transformerClass);

        return $fractal->createData($resource)->toArray();
    }

    /**
     * @param array|ArrayAccess $item
     * @param string            $transformerClass
     *
     * @return array
     * @throws BindingResolutionException
     */
    public function transformCollection(array|ArrayAccess $item, string $transformerClass): array
    {
        /** @var Manager $fractal */
        $fractal  = app()->make(Manager::class);
        $resource = new Collection($item, new $transformerClass);

        return $fractal->createData($resource)->toArray();
    }
}
