<?php

namespace Raakkan\Yali\Core\Support\Concerns;

trait HasPageMessages
{
    protected static $tablePageMessage = '';
    protected static $updatePageMessage = '';
    protected static $createPageMessage = '';
    protected static $allPageMessage = '';
    protected static $tablePageMessageType = 'info';
    protected static $updatePageMessageType = 'info';
    protected static $createPageMessageType = 'info';
    protected static $allPageMessageType = 'info';

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
}
