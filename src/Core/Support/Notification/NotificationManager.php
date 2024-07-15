<?php

namespace Raakkan\Yali\Core\Support\Notification;

class NotificationManager
{
    public $notifications = [];

    public function addNotification($id, Notification $notification)
    {
        $this->notifications[$id] = $notification;

        return $this;
    }

    public function getNotification($id)
    {
        return $this->notifications[$id] ?? null;
    }

    public function getNotifications()
    {
        return $this->notifications;
    }
}
