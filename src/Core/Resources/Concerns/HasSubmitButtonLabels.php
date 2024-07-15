<?php

namespace Raakkan\Yali\Core\Resources\Concerns;

trait HasSubmitButtonLabels
{
    protected static $createButtonLabel = '';

    protected static $updateButtonLabel = '';

    public static function getCreateButtonLabel(): string
    {
        return static::$createButtonLabel ?: 'Create';
    }

    public static function getUpdateButtonLabel(): string
    {
        return static::$updateButtonLabel ?: 'Update';
    }
}
