<?php

namespace Raakkan\Yali\Core\Support\Navigation;

use Str;

trait HasNavigation
{
    protected static $slug = '';
    protected static $navigationLabel = '';
    protected static $navigationGroup = '';
    protected static $navigationGroupIcon = '';
    protected static $navigationIcon = '';
    protected static $navigationOrder = 0;

    public static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?: Str::plural((static::getTitle()));
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

    public static function getNavigationIcon()
    {
        return static::$navigationIcon;
    }

    public static function setNavigationIcon($navigationIcon): void
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

    public static function getNavigationGroupIcon()
    {
        return static::$navigationGroupIcon;
    }

    public function setNavigationGroupIcon($navigationGroupIcon)
    {
        $this->navigationGroupIcon = $navigationGroupIcon;

        return $this;
    }

    public static function getPath(): string
    {
        return '/admin/' . static::getSlug();
    }

    public static function createNavigationItem(): NavigationItem
    {
        $navigationItem = new NavigationItem(
            label: static::getNavigationLabel(),
            slug: static::getSlug(),
            routeName: static::getRouteName(),
            class: static::class,
            type: static::getType(),
            icon: static::getNavigationIcon(),
            order: static::getNavigationOrder(),
            path: static::getPath(),
        );

        if (method_exists(static::class, 'getChildNavigationItems')) {
            $childItems = static::getChildNavigationItems();

            foreach ($childItems as $childItem) {
                $childNavigationItem = new NavigationItem(
                    label: $childItem['label'],
                    slug: $childItem['slug'],
                    routeName: $childItem['route'],
                    class: $childItem['class'],
                    type: $childItem['type'],
                    icon: $childItem['icon'],
                    order: $childItem['order'],
                    path: $childItem['path'],
                    hidden: $childItem['isHidden'] ?? false
                );

                $navigationItem->addChild($childNavigationItem);
            }
        }

        if (method_exists(static::class, 'getPages')) {
            foreach (static::getPages() as $page) {
                $navigationItem->addChild($page::createNavigationItem());
            }
        }

        return $navigationItem;
    }

}
