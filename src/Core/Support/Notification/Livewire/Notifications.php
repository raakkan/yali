<?php

namespace Raakkan\Yali\Core\Support\Notification\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Notifications extends Component
{
    public $notifications = [];

    #[On('notifications-sent')]
    public function getNotifications()
    {
        $this->notifications = session()->pull('yali.notifications');
    }

    public function render()
    {
        return view('yali::notification.notifications')->layout('yali::layouts.app');
    }
}