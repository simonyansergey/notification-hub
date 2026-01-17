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
        $driver = config('services.notification.provider', 'email');

        $implementation = match($driver) {
            'sms' => SmsService::class,
            'email' => EmailService::class,
            default => EmailService::class,
        };

        $this->app->bind(NotificationInterface::class, $implementation);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
