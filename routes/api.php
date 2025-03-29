<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// make path like this
// mywebsite.com/api/v1/products

/**
 * Don't forgot to use header like this:
 * Accept: application/json
 * Content-Type: application/json
 */

Route::group(['middleware' => ['api'],'prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
        Route::post('otp/send', [AuthController::class, 'sendOtp'])->name('send-otp');
        Route::post('otp/verify', [AuthController::class, 'verifyOtp'])->name('verify-otp');
        Route::post('register', [AuthController::class, 'register'])->name('register');
    });

    Route::group(['middleware' => ['auth:api']], function() {
        Route::apiResource('products', ProductController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('transactions', TransactionController::class);

        Route::get('profile', [AuthController::class, 'profile'])->name('profile');
        Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    });
});
