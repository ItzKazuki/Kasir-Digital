<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return redirect()->route('auth.login');
})->name('home');

// start authentication
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::get('forgot', [ForgotPasswordController::class, 'forgot'])->name('forgot');
    Route::get('reset/{token}', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');

    // for post method
    Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
    Route::post('register', [RegisterController::class, 'store'])->name('store');
    Route::post('forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('send-reset-link-email');
    Route::post('reset/password', [ResetPasswordController::class, 'update'])->name('update');
});
Route::post('/auth/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');
// end authentication

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('users', UserController::class)->middleware(AdminMiddleware::class);
    Route::resource('members', MemberController::class)->middleware(AdminMiddleware::class);
    Route::resource('products', ProductController::class)->middleware(AdminMiddleware::class);
    Route::resource('discounts', DiscountController::class)->middleware(AdminMiddleware::class);
    Route::resource('categories', CategoryController::class)->middleware(AdminMiddleware::class);
    Route::resource('transactions', TransactionController::class)->middleware(AdminMiddleware::class);
});

Route::get('/kasir', function () {
    $title = "Home";
    return view('kasir.index2', compact('title'));
});
