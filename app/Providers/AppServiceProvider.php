<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Payments\MidtransPaymentService;
use App\Services\Payments\PaymentGatewayInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayInterface::class, function () {
            switch (config('payment.default')) {
                case 'midtrans':
                    return new MidtransPaymentService();
                    
                // Add other payment gateways here
                default:
                    return new MidtransPaymentService();
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return route('auth.reset-password', ['token' => $token]);
        });

        Paginator::defaultView('pagination::default');
    }
}
