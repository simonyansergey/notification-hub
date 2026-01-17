<?php

namespace App\Providers;

use App\Interfaces\NotificationInterface;
use App\Services\Notification\EmailService;
use App\Services\Notification\SmsService;
use Illuminate\Support\ServiceProvider;

class NotificationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        match(config('services.notification.provider')) {
            'email' => $this->app->bind(NotificationInterface::class, EmailService::class),
            'sms' => $this->app->bind(NotificationInterface::class, SmsService::class)
        };
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
