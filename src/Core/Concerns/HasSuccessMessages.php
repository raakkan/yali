<?php

namespace Raakkan\Yali\Core\Concerns;

trait HasSuccessMessages
{
    protected static $createdSuccessMessage = '';
    protected static $updatedSuccessMessage = '';
    protected static $softDeletedSuccessMessage = '';
    protected static $deletedSuccessMessage = '';

    public static function getCreatedSuccessMessage(): string
    {
        return static::$createdSuccessMessage ?: static::getTitle() . ' created successfully.';
    }

    public static function getUpdatedSuccessMessage(): string
    {
        return static::$updatedSuccessMessage ?: static::getTitle() . ' updated successfully.';
    }

    public static function getSoftDeletedSuccessMessage(): string
    {
        return static::$softDeletedSuccessMessage ?: static::getTitle() . ' deleted successfully.';
    }

    public static function getDeletedSuccessMessage(): string
    {
        return static::$deletedSuccessMessage ?: static::getTitle() . ' deleted successfully.';
    }
}
