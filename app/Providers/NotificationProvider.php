<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Notification\NotificationManager;

class NotificationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            NotificationManager::class,
            fn ($app) => new NotificationManager($app)
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
