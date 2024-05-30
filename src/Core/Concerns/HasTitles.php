<?php

namespace Raakkan\Yali\Core\Concerns;

use Illuminate\Support\Str;

trait HasTitles
{
    protected static $title = '';
    protected static $subtitle = '';
    protected static $createPageTitle = '';
    protected static $updatePageTitle = '';
    protected static $createPageSubtitle = '';
    protected static $updatePageSubtitle = '';

    public static function title(): string
    {
        return static::$title ?: Str::title(static::getDefaultTitle());
    }

    public static function getTitle(): string
    {
        return static::$title ?: Str::title(static::getDefaultTitle());
    }

    public static function getPluralTitle(): string
    {
        return Str::plural(static::getTitle());
    }

    public static function getSubtitle(): string
    {
        return static::$subtitle;
    }

    public static function getCreatePageTitle(): string
    {
        return static::$createPageTitle ?: 'Create ' . static::getTitle();
    }

    public static function getUpdatePageTitle(): string
    {
        return static::$updatePageTitle ?: 'Update ' . static::getTitle();
    }

    public static function getCreatePageSubtitle(): string
    {
        return static::$createPageSubtitle;
    }

    public static function getUpdatePageSubtitle(): string
    {
        return static::$updatePageSubtitle;
    }
}
