<?php

namespace Raakkan\Yali\Core\Resources\Concerns;

use Illuminate\Support\Str;
use Raakkan\Yali\Core\Resources\Pages\EditPage;

trait HasResourceTitles
{
    protected static $subtitle = '';
    protected static $createTitle = '';
    protected static $updateTitle = '';
    protected static $viewTitle = '';

    public static function getTitle(): string
    {
        return static::$title ?: Str::title(Str::plural(static::getModelName()));
    }

    public static function getCreateTitle(): string
    {
        return static::$createTitle ?: 'Create ' . Str::title(static::getModelName());
    }

    public static function getViewTitle(): string
    {
        return static::$viewTitle ?: 'View ' . Str::title(static::getModelName());
    }

    public static function getUpdateTitle(): string
    {
        return static::$updateTitle ?: 'Update ' . Str::title(static::getModelName());
    }

    public static function getSubtitle(): string
    {
        return static::$subtitle;
    }

    public static function hasEditPage(): bool
    {
        if (method_exists(static::class,'getPages')) {
            $pages = static::getPages();
            
            return collect($pages)->contains(function ($page) {
                return $page instanceof EditPage;
            });
        }

        return false;
    }
}