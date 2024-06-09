<?php

namespace Raakkan\Yali\Core\Resources\Pages;

use Illuminate\Support\Str;

class CreatePage extends ResourcePage
{
    protected static $view = 'yali::resources.pages.create-page';

    public static function getRouteName()
    {
        return static::getResource()::getRouteName() . '.create';
    }

    public static function getSlug(): string
    {
        return parent::getSlug(). '/create';
    }
}
