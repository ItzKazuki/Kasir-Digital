<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// make path like this
// mywebsite.com/api/v1/products

Route::group(['middleware' => ['api'],'prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function() {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });

    Route::group(['middleware' => ['auth:sanctum']], function() {
        Route::apiResource('products', ProductController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('transactions', TransactionController::class);

        Route::get('profile', [AuthController::class, 'profile']);
        Route::get('auth/logout', [AuthController::class, 'logout']);
    });
});
