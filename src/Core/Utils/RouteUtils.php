<?php

namespace Raakkan\Yali\Core\Utils;

use Illuminate\Support\Str;

class RouteUtils
{
    public static function getRouteNameByClass($class)
    {
        return Str::kebab(Str::plural($class::getType()) . str_replace('\\', '', $class));
    }

    public static function getCreateRouteNameByClass($class)
    {
        return self::getRouteNameByClass($class) . '.create';
    }

    public static function getEditRouteNameByClass($class)
    {
        return self::getRouteNameByClass($class) . '.edit';
    }
}
