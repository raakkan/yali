<?php

namespace Raakkan\Yali\Core\Resources\Pages;

use Illuminate\Support\Str;
use Raakkan\Yali\Core\Pages\BasePage;

abstract class ResourcePage extends BasePage
{
    protected static $resource;

    protected static $subtitle = '';

    public static function getTitle(): string
    {
        return static::$title ?: Str::title(Str::plural(static::getModelName()));
    }

    public static function getSubtitle(): string
    {
        return static::$subtitle;
    }
    
    public static function getSlug(): string
    {
        return static::getResource()::getSlug();
    }

    public static function getType(): string
    {
        return 'page';
    }

    public static function setResource(string $resource)
    {
        static::$resource = $resource;
    }

    public static function getResource()
    {
        if (!class_exists(static::$resource)) {
            throw new \InvalidArgumentException("Resource class '" . static::$resource . "' does not exist.");
        }

        return static::$resource;
    }

    public static function getModel(): string
    {
        return static::getResource()::getModel();
    }

    public static function getModelName(): string
    {
        return class_basename(static::getModel());
    }
}