<?php

namespace App\Providers;

use Laravel\Fortify\Fortify;
use App\Actions\Fortify\TwoFactorAuthenticates;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::authenticateThrough(function (Request $request) {
            return array_filter([
                config('fortify.limiters.login') ? null : AttemptsAuthentication::class,
                TwoFactorAuthenticates::class,
            ]);
        });
    }
}
