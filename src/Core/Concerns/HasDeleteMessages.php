<?php

namespace Raakkan\Yali\Core\Concerns;

use Illuminate\Support\Str;

trait HasDeleteMessages
{
    // protected static $deleteLabel = '';
    // protected static $hardDeleteLabel = '';
    protected static $deleteTitle = '';
    protected static $deleteMessage = '';
    protected static $hardDeleteTitle = '';
    protected static $hardDeleteMessage = '';

    public static function getDeleteTitle(): string
    {
        return static::$deleteTitle ?: 'Delete ' . Str::title(static::getDefaultTitle());
    }

    public static function getDeleteMessage(): string
    {
        return static::$deleteMessage ?: 'Are you sure you want to delete this ' . Str::title(static::getDefaultTitle()) . '?';
    }

    public static function getHardDeleteTitle(): string
    {
        return static::$hardDeleteTitle ?: 'Hard Delete ' . Str::title(static::getDefaultTitle());
    }

    public static function getHardDeleteMessage(): string
    {
        return static::$hardDeleteMessage ?: 'Are you sure you want to hard delete this ' . Str::title(static::getDefaultTitle()) . '?';
    }
}
