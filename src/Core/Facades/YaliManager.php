<?php

namespace Raakkan\Yali\Core\Facades;

use Illuminate\Support\Facades\Facade;

class YaliManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'yali-manager';
    }
}
