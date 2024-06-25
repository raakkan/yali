<?php

namespace Raakkan\Yali\Core\Support\Notification;

use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\Concerns\UI\Iconable;
use Illuminate\Support\Traits\Conditionable;

class Notification
{
    use Makable;
    use Conditionable;
    use Iconable;

    public $title;
    public $content;
    public $timeout = 3000;
    public $type = 'success';

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    public function timeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function success()
    {
        $this->type = 'success';
        return $this;
    }

    public function send()
    {
        $store = session()->get('notification', []);
        $notifications[uniqid()] = [
            'title' => $this->title,
            'content' => $this->content,
            'timeout' => $this->timeout,
            'type' => $this->type
        ];
        $messages = array_merge($store, $notifications);

        session()->flash('notification', $messages);
    }
}
