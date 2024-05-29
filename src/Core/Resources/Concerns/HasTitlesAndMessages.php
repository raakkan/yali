<?php

namespace Raakkan\Yali\Core\Resources\Concerns;

use Illuminate\Support\Str;

trait HasTitlesAndMessages
{
    protected static $title = '';
    protected static $subtitle = '';
    protected static $createPageTitle = '';
    protected static $updatePageTitle = '';
    protected static $tablePageMessage = '';
    protected static $updatePageMessage = '';
    protected static $createPageMessage = '';
    protected static $tablePageMessageType = 'info';
    protected static $updatePageMessageType = 'info';
    protected static $createPageMessageType = 'info';

    public static function title(): string
    {
        return static::$title ?: Str::title(static::getModelName());
    }

    public static function getTitle(): string
    {
        return static::$title ?: Str::title(static::getModelName());
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
        return static::$createPageTitle ?: 'Create ' . static::title();
    }

    public static function getUpdatePageTitle(): string
    {
        return static::$updatePageTitle ?: 'Update ' . static::title();
    }

    public static function getTablePageMessage(): string
    {
        return static::$tablePageMessage;
    }

    public static function getUpdatePageMessage(): string
    {
        return static::$updatePageMessage;
    }

    public static function getCreatePageMessage(): string
    {
        return static::$createPageMessage;
    }

    public static function getTablePageMessageType(): string
    {
        return static::$tablePageMessageType;
    }

    public static function getUpdatePageMessageType(): string
    {
        return static::$updatePageMessageType;
    }

    public static function getCreatePageMessageType(): string
    {
        return static::$createPageMessageType;
    }
}
