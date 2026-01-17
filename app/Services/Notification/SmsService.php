<?php

namespace App\Services\Notification;

use App\Interfaces\NotificationInterface;

class SmsService implements NotificationInterface
{
    public function send(string $to, string $message): bool
    {
        logger()->info("Test sms message", [
            "to" => $to,
            "message" => $message
        ]);

        return true;
    }
}
