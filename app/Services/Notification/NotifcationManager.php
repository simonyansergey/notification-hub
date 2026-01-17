<?php

namespace App\Services\Notification;

use InvalidArgumentException;
use App\Interfaces\NotificationInterface;
use App\Services\Notification\SmsService;
use Illuminate\Contracts\Foundation\Application;

class NotifcationManager
{
    protected array $drivers = [];

    public function __construct(
        private readonly Application $app
    ) {}

    public function driver(?string $name = null): NotificationInterface
    {
        $name ??= config('services.notification.provider', 'email');

        if ($this->drivers[$name]) {
            return $this->drivers[$name];
        }

        return $this->drivers[$name] = $this->resolve($name);
    }

    private function resolve(string $name)
    {
        $method = 'create' . ucfirst($name) . 'Driver';

        if (! method_exists($this, $method)) {
            throw new InvalidArgumentException("Driver [$name] is not supported.");
        }

        return $this->$method();
    }

    private function createEmailDriver()
    {
        return $this->app->make(EmailService::class);
    }

    private function createSmsDriver()
    {
        return $this->app->make(SmsService::class);
    }
}
