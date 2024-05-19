<?php

namespace Raakkan\Yali\Core\Facades;

use Illuminate\Support\Facades\Facade;

class PageManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pagemanager';
    }
}
