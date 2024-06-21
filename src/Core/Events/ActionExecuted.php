<?php

namespace Raakkan\Yali\Core\Events;

use Illuminate\Queue\SerializesModels;
use Raakkan\Yali\Core\Actions\YaliAction;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ActionExecuted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;
    public $result;

    public function __construct()
    {
    }
}