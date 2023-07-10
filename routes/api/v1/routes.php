<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\ProductController as DashboardProductController;
use Illuminate\Support\Facades\Route;

#Admin
Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => 'dashboard'], function () {

    #Categories crud
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [DashboardCategoryController::class, 'index']);
        Route::post('/', [DashboardCategoryController::class, 'store']);
        Route::patch('{id}', [DashboardCategoryController::class, 'update']);
        Route::delete('{id}', [DashboardCategoryController::class, 'delete']);
    });

    #Product crud
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [DashboardProductController::class, 'index']);
        Route::get('{id}', [DashboardProductController::class, 'show']);
        Route::post('/', [DashboardProductController::class, 'store']);
        Route::patch('{id}', [DashboardProductController::class, 'update']);
        Route::delete('{id}', [DashboardProductController::class, 'delete']);
    });

});


#Client

#Product
Route::group(['prefix' => 'products'], function () {
    Route::get('/', [DashboardProductController::class, 'index']);
    Route::get('{id}', [DashboardProductController::class, 'show']);
});

#CartItem
Route::group(['prefix' => 'cart', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/', [CartController::class, 'store']);
    Route::delete('/{id}', [CartController::class, 'delete']);
});

#Categories
Route::get('categories', [CategoryController::class, 'list']);


