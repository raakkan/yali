<?php

namespace Raakkan\Yali\Core\Support\Navigation;

trait HasNavigation
{
    protected static $slug = '';
    protected static $navigationLabel = '';
    protected static $navigationGroup = '';
    protected static $navigationIcon = '';
    protected static $navigationOrder = 0;

    public static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?: static::getTitle();
    }

    public static function setNavigationLabel(string $navigationLabel): void
    {
        static::$navigationLabel = $navigationLabel;
    }

    public static function getNavigationGroup(): string
    {
        return static::$navigationGroup;
    }

    public static function setNavigationGroup(string $navigationGroup): void
    {
        static::$navigationGroup = $navigationGroup;
    }

    public static function getNavigationIcon(): string
    {
        return static::$navigationIcon;
    }

    public static function setNavigationIcon(string $navigationIcon): void
    {
        static::$navigationIcon = $navigationIcon;
    }

    public static function getNavigationOrder(): int
    {
        return static::$navigationOrder;
    }

    public static function setNavigationOrder(int $navigationOrder): void
    {
        static::$navigationOrder = $navigationOrder;
    }
 
    public static function getSlug()
    {
        return static::$slug;
    }

    public static function setSlug($slug)
    {
        static::$slug = $slug;
    }
}
