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
    protected static $allPageMessage = '';
    protected static $tablePageMessageType = 'info';
    protected static $updatePageMessageType = 'info';
    protected static $createPageMessageType = 'info';
    protected static $allPageMessageType = 'info';
    protected static $createSubmitButtonLabel = '';
    protected static $updateSubmitButtonLabel = '';

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
        return static::$tablePageMessage ?: (static::getAllPageMessage() ?: '');
    }

    public static function getUpdatePageMessage(): string
    {
        return static::$updatePageMessage ?: (static::getAllPageMessage() ?: '');
    }

    public static function getCreatePageMessage(): string
    {
        return static::$createPageMessage ?: (static::getAllPageMessage() ?: '');
    }

    public static function getAllPageMessage(): string
    {
        return static::$allPageMessage ?: '';
    }

    public static function getTablePageMessageType(): string
    {
        if (static::getTablePageMessage() === static::getAllPageMessage()) {
            return static::getAllPageMessageType() ?: 'info';
        }
        return static::$tablePageMessageType ?: 'info';
    }

    public static function getUpdatePageMessageType(): string
    {
        if (static::getUpdatePageMessage() === static::getAllPageMessage()) {
            return static::getAllPageMessageType() ?: 'info';
        }
        return static::$updatePageMessageType ?: 'info';
    }

    public static function getCreatePageMessageType(): string
    {
        if (static::getCreatePageMessage() === static::getAllPageMessage()) {
            return static::getAllPageMessageType() ?: 'info';
        }
        return static::$createPageMessageType ?: 'info';
    }

    public static function getAllPageMessageType(): string
    {
        return static::$allPageMessageType ?: 'info';
    }

    public static function getCreateSubmitButtonLabel(): string
    {
        return static::$createSubmitButtonLabel ?: 'Create';
    }

    public static function getUpdateSubmitButtonLabel(): string
    {
        return static::$updateSubmitButtonLabel ?: 'Update';
    }
}
