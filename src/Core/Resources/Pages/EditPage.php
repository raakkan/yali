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

    public function mount($record)
    {
        $this->model = $this->getResource()::getModelInstance()->find($record);
        $this->fillForm();
    }

    public static function getTitle(): string
    {
        return static::$title ?: 'Edit ' . Str::title(static::getResource()::getModelName());
    }

    public static function getFormSubmitButtonLabel(): string
    {
        return static::$formSubmitButtonLabel ?? 'Update';
    }
}