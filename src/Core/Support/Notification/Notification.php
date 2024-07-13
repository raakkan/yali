<?php

namespace Raakkan\Yali\Core\Support\Notification;

use Livewire\Component;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Facades\YaliManager;
use Illuminate\Support\Traits\Conditionable;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Support\Concerns\UI\Iconable;

class Notification extends YaliComponent
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
        session()->push('yali.notifications', $this->toArray());

        $this->getLivewire()->dispatch('notifications-sent');

        return $this;
    }

    public $livewire;

    public function livewire($livewire)
    {
        $this->livewire = $livewire;
        return $this;
    }

    public function getLivewire()
    {
        if (!$this->livewire) {
            $callerMeta = $this->getCallerMetadata();
            $callerObject = array_key_exists('object', $callerMeta) ? $callerMeta['object'] : null;

            if ($callerObject && $callerObject instanceof Component) {
                $this->livewire = $callerObject;
            }
        }

        return $this->livewire;
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'timeout' => $this->timeout,
            'type' => $this->type,
            'livewire' => $this->livewire,
            'icon' => $this->getIconView(),
        ];
    }

    public function fromArray(array $data)
    {
        $this->title = $data['title'] ?? $this->title;
        $this->message = $data['message'] ?? $this->message;
        $this->timeout = $data['timeout'] ?? $this->timeout;
        $this->type = $data['type'] ?? $this->type;
        $this->livewire = $data['livewire'] ?? $this->livewire;
        $this->icon = $data['icon'] ?? $this->icon;

        return $this;
    }
}
