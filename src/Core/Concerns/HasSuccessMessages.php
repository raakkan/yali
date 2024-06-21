<?php

namespace Raakkan\Yali\Core\Concerns;

trait HasSuccessMessages
{
    protected static $createdSuccessMessage = '';
    protected static $updatedSuccessMessage = '';
    protected static $hardDeletedSuccessMessage = '';
    protected static $deletedSuccessMessage = '';
    protected static $restoradSuccessMessage = '';

    public static function getCreatedSuccessMessage(): string
    {
        return static::$createdSuccessMessage ?: static::getTitle() . ' created successfully.';
    }

    public static function getUpdatedSuccessMessage(): string
    {
        return static::$updatedSuccessMessage ?: static::getTitle() . ' updated successfully.';
    }

    public static function getHardDeletedSuccessMessage(): string
    {
        return static::$hardDeletedSuccessMessage ?: static::getTitle() . ' permanently deleted successfully.';
    }

    public static function getDeletedSuccessMessage(): string
    {
        return static::$deletedSuccessMessage ?: static::getTitle() . ' deleted successfully.';
    }

    public static function getRestoredSuccessMessage(): string
    {
        return static::$restoradSuccessMessage ?: static::getTitle() . ' restored successfully.';
    }
}
