<?php

namespace Raakkan\Yali\Core\Support\Notification\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications = [];

    #[On('notifications-sent')]
    public function getNotifications()
    {
        $notifications = session()->pull('yali.notifications', []);

        foreach ($notifications as $notification) {
            $this->notifications[] = $notification;
        }
    }

    public function clear()
    {
        session()->forget('yali.notifications');
    }

    public function render()
    {
        return view('yali::notification.notifications')->layout('yali::layouts.app');
    }
}
