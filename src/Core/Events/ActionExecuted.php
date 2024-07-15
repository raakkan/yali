<?php

namespace Raakkan\Yali\Core\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActionExecuted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;

    public $result;

    public function __construct() {}
}
