<?php

namespace App\Services\Notification;

use App\Interfaces\NotificationInterface;

class EmailService implements NotificationInterface
{
    public function send(string $to, string $message): bool
    {
        logger()->info("Test email message", [
            "to" => $to,
            "message" => $message
        ]);

        return true;
    }
}
