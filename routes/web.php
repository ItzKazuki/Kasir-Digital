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
use App\Http\Controllers\Kasir\CartController;
use App\Http\Controllers\Kasir\TransactionController as KasirTransactionController;
use App\Http\Controllers\Kasir\ProductController as KasirProductController;
use App\Http\Middleware\KasirMiddleware;

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

    Route::resource('products', ProductController::class);
    Route::resource('discounts', DiscountController::class);
    Route::resource('categories', CategoryController::class);

    Route::group(['middleware' => [KasirMiddleware::class], 'prefix' => 'kasir', 'as' => 'kasir.'], function() {
        Route::get('products', [KasirProductController::class, 'index'])->name('products.index');
        Route::post('cart/products/{product}/add', [CartController::class, 'storeCart'])->name('cart.store');
        Route::post('cart/products/{cartProductId}/remove', [CartController::class, 'removeItemCart'])->name('cart.removeItem');
        Route::post('cart/products/{cartProductId}/increment', [CartController::class, 'incrementItemCart'])->name('cart.incrementItem');
        Route::post('cart/products/{cartProductId}/decrement', [CartController::class, 'decrementItemCart'])->name('cart.decrementItem');
        Route::get('cart/products/show', [CartController::class, 'showCart'])->name('cart.show');

        Route::post('members/search', [KasirTransactionController::class, 'searchMember'])->name('member.search');

        Route::post('transactions/add', [KasirTransactionController::class, 'store'])->name('transactions.store');
        Route::get('transactions', [KasirTransactionController::class, 'index'])->name('transactions.index');
    });

    Route::group(['middleware' => [AdminMiddleware::class]], function () {
        Route::resource('users', UserController::class);
        Route::resource('members', MemberController::class);

        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::delete('transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
        Route::put('transactions/{transaction}/payment/update-status', [TransactionController::class, 'updateStatusPayment'])->name('transactions.payment.updateStatus');
    });

    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('transactions/{transaction}/print', [TransactionController::class, 'print'])->name('transactions.print');
    Route::get('transactions/{transaction}/pdf', [TransactionController::class, 'pdf'])->name('transactions.pdf');
    Route::post('transactions/{transaction}/sendWhatsapp', [TransactionController::class, 'sendWhatsappMessage'])->name('transactions.send.whatsapp');
});

Route::get('/kasir', function () {
    $title = "Home";
    return view('kasir.index2', compact('title'));
});

Route::get('/struk/{invoice}', [TransactionController::class, 'streamStruk'])->name('struk.search');
