<?php

namespace App\Providers;

use App\Services\InfobipService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(InfobipService::class, function ($app) {
            return new InfobipService();
        });
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
