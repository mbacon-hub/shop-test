<?php

namespace App\Providers;

use App\Repositories\Eloquent\CartItemEloquentRepository;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\ProductEloquentRepository;
use App\Repositories\Eloquent\UserEloquentRepository;
use App\Repositories\Interfaces\CartItemRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Auth\LoginService;
use App\Services\CartItem\CartItemDeleteService;
use App\Services\CartItem\CartItemStoreService;
use App\Services\Category\CategoryDeleteService;
use App\Services\Category\CategoryUpdateService;
use App\Services\Interfaces\CartItemDeleteInterface;
use App\Services\Interfaces\CartItemStoreInterface;
use App\Services\Interfaces\CategoryDeleteInterface;
use App\Services\Interfaces\CategoryUpdateInterface;
use App\Services\Interfaces\LoginInterface;
use App\Services\Interfaces\ProductDeleteInterface;
use App\Services\Interfaces\ProductStoreInterface;
use App\Services\Interfaces\ProductUpdateInterface;
use App\Services\Product\ProductDeleteService;
use App\Services\Product\ProductStoreService;
use App\Services\Product\ProductUpdateService;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Repositories
        $this->app->bind(UserRepositoryInterface::class, UserEloquentRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryEloquentRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductEloquentRepository::class);
        $this->app->bind(CartItemRepositoryInterface::class, CartItemEloquentRepository::class);

        //Services
        $this->app->bind(LoginInterface::class, LoginService::class);
        $this->app->bind(CategoryUpdateInterface::class, CategoryUpdateService::class);
        $this->app->bind(CategoryDeleteInterface::class, CategoryDeleteService::class);
        $this->app->bind(ProductStoreInterface::class, ProductStoreService::class);
        $this->app->bind(ProductUpdateInterface::class, ProductUpdateService::class);
        $this->app->bind(ProductDeleteInterface::class, ProductDeleteService::class);
        $this->app->bind(CartItemStoreInterface::class, CartItemStoreService::class);
        $this->app->bind(CartItemDeleteInterface::class, CartItemDeleteService::class);

        $this->app->when(ProductStoreService::class)
            ->needs(Filesystem::class)
            ->give(function () {
                return Storage::drive('public');
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
