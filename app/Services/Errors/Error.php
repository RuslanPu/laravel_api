<?php

namespace App\Services\Errors;

use App\Jobs\SendErrorEmail;
use App\Models\Notification;

class Error
{
    public static  function notificate(string $class, string $title, string $content, string $email): void
    {
        Notification::create([
            'logging_class' => $class,
            'title' => $title,
            'content' => $content,
            'tags' => 'error',
            'is_error' => true
        ]);

        SendErrorEmail::dispatch($class, $title, $content, $email);
    }
}
