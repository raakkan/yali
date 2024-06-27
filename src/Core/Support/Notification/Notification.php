<?php

namespace Raakkan\Yali\Core\Support\Notification;

use Illuminate\Support\Facades\Session;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Iconable;
use Illuminate\Support\Traits\Conditionable;

class Notification  extends YaliComponent
{
    use Makable;
    use Conditionable;
    use Iconable;

    protected $componentName = 'notification';

    protected $view = 'yali::notification.notification';

    public $title;
    public $message;
    public $timeout = 3000;
    public $type = 'success';

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    public function hasMessage()
    {
        return !empty($this->message);
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function timeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public function success()
    {
        $this->type = 'success';
        return $this;
    }

    public function send()
    {
        $id = uniqid();

        app(NotificationManager::class)->addNotification($id, $this);

        session()->push('yali.notifications', [$id]);

        return $this;
    }
}
