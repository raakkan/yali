<?php

namespace Raakkan\Yali\Core\Concerns;

trait HasButtonLabels
{
    protected static $createSubmitButtonLabel = '';
    protected static $updateSubmitButtonLabel = '';

    public static function getCreateSubmitButtonLabel(): string
    {
        return static::$createSubmitButtonLabel ?: 'Create';
    }

    public static function getUpdateSubmitButtonLabel(): string
    {
        return static::$updateSubmitButtonLabel ?: 'Update';
    }
}
