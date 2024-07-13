<?php

namespace Raakkan\Yali\Core\Support\Notification;

use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Support\Concerns\Makable;

class NotificationRenderer extends YaliComponent
{
    use Makable;
    protected $view = 'yali::notification.notification-renderer';
}
