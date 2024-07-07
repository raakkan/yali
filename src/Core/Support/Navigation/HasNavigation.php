<?php

namespace Raakkan\Yali\Core\Support\Navigation;

use Str;

trait HasNavigation
{
    protected static $slug = '';

    // Navigation Item
    protected static $navigationLabel = '';
    protected static $navigationIcon = '';
    protected static $navigationOrder = 0;

    // Navigation Group
    protected static $navigationGroup = '';
    protected static $navigationGroupIcon = '';
    protected static $navigationGroupOrder = 0;

    public static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?: Str::plural((static::getTitle()));
    }

    public static function getNavigationIcon()
    {
        return static::$navigationIcon;
    }

    public static function getNavigationOrder(): int
    {
        return static::$navigationOrder;
    }
 
    public static function getSlug()
    {
        return static::$slug;
    }

    public static function isHidden(): bool
    {
        return false;
    }

    public static function getNavigationGroup(): string
    {
        return static::$navigationGroup;
    }

    public static function getNavigationGroupIcon()
    {
        return static::$navigationGroupIcon;
    }

    public static function getNavigationGroupOrder(): int
    {
        return static::$navigationGroupOrder;
    }

    public static function createNavigationItem(): NavigationItem | NavigationGroup
    {
        $navigationItem = NavigationItem::make(
            label: static::getNavigationLabel(),
            slug: static::getSlug(),
            routeName: static::getRouteName(),
            class: static::class,
            type: static::getType(),
            icon: static::getNavigationIcon(),
            order: static::getNavigationOrder(),
            hidden: static::isHidden()
        );

        if (method_exists(static::class, 'getChildNavigationItems')) {
            $childItems = static::getChildNavigationItems();

            foreach ($childItems as $childItem) {
                $childNavigationItem = NavigationItem::make(
                    label: $childItem['label'],
                    slug: $childItem['slug'],
                    routeName: $childItem['route'],
                    class: $childItem['class'],
                    type: $childItem['type'],
                    icon: $childItem['icon'],
                    order: $childItem['order'],
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

        if(static::getNavigationGroup()) {
            $navigationGroup = NavigationGroup::make(static::getNavigationGroup());
            $navigationGroup->setIcon(static::getNavigationGroupIcon());
            $navigationGroup->setOrder(static::getNavigationGroupOrder());

            $navigationGroup->addItem($navigationItem);

            return $navigationGroup;
        }

        return $navigationItem;
    }

}
