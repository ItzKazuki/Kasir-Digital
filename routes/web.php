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
use App\Http\Controllers\Admin\SettingController;
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
Route::post('/auth/logout', [LogoutController::class, 'logout'])->name('auth.logout')->middleware('auth');
// end authentication

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/profile', function () {
        $title = "Profile";
        return view('dashboard.profile', compact('title'));
    })->name('profile');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settings/{user}', [SettingController::class, 'update'])->name('settings.update-user');
    Route::patch('/settings/profile/{user}', [SettingController::class, 'updateProfile'])->name('settings.update-profile');
    Route::delete('/settings/profile/{user}', [SettingController::class, 'deleteProfile'])->name('settings.delete-profile');

    Route::group(['middleware' => [AdminMiddleware::class]], function () {
        Route::resource('users', UserController::class);
        Route::resource('members', MemberController::class);
        Route::resource('products', ProductController::class);
        Route::resource('discounts', DiscountController::class);
        Route::resource('categories', CategoryController::class);

        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::get('transactions/{transaction}/print', [TransactionController::class, 'print'])->name('transactions.print');
        Route::get('transactions/{transaction}/pdf', [TransactionController::class, 'pdf'])->name('transactions.pdf');
        Route::delete('transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    });
});

Route::get('/kasir', function () {
    $title = "Home";
    return view('kasir.index2', compact('title'));
});

Route::get('/struk/{invoice}', [TransactionController::class, 'search'])->name('struk.search');
