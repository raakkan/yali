<?php

namespace Raakkan\Yali\Core\Pages;

use Illuminate\Support\Str;

abstract class YaliPage extends BasePage
{
    public static function getSlug(): string
    {
        return static::$slug ?: Str::plural(Str::kebab(class_basename(static::class)));
    }

    public static function getTitle(): string
    {
        return static::$title ?: Str::title(class_basename(static::class));
    }

    public static function getType(): string
    {
        return 'page';
    }
}
