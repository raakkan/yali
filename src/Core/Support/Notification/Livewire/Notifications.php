<?php

namespace Raakkan\Yali\Core\Support\Notification\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class Notifications extends Component
{
    public $notifications = [];

    #[On('notifications-sent')]
    public function getNotifications()
    {
        $this->notifications = ['id' => 22];
        Log::info('notification sent', $this->notifications);
    }

    public function render()
    {
        return view('yali::notification.notifications')->layout('yali::layouts.app');
    }
}