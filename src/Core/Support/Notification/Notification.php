<?php

namespace Raakkan\Yali\Core\Support\Notification;

class Notification
{
    public static function success($message)
    {
        session()->flash('success', $message);
    }
}