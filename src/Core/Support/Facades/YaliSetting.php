<?php

namespace Raakkan\Yali\Core\Support\Facades;

use Illuminate\Support\Facades\Facade;

class YaliSetting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'yali-settings';
    }
}
