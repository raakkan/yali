<?php

namespace Raakkan\Yali\Core\Resources\Pages;

use Illuminate\Support\Str;

class EditPage extends ResourcePage
{
    protected static $view = 'yali::resources.pages.edit-page';

    public static function getRouteName()
    {
        return static::getResource()::getRouteName() . '.edit';
    }

    public static function getSlug(): string
    {
        return parent::getSlug(). '/{record}/edit'; 
    }
}