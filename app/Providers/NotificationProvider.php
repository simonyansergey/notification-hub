<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Notification\NotifcationManager;

class NotificationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            NotifcationManager::class,
            fn ($app) => new NotifcationManager($app)
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
