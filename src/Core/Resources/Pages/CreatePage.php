<?php

namespace Raakkan\Yali\Core\Resources\Pages;

use Illuminate\Support\Str;

class CreatePage extends ResourcePage
{
    protected static $view = 'yali::resources.pages.create-page';

    public function mount()
    {
        $this->model = $this->getResource()::getModel();
        $this->fillForm();
    }

    public static function getTitle(): string
    {
        return static::$title ?: 'Create ' . Str::title(static::getResource()::getModelName());
    }

    public static function getRouteName()
    {
        return static::getResource()::getRouteName() . '.create';
    }

    public static function getSlug(): string
    {
        return parent::getSlug(). '/create';
    }

    public static function getFormSubmitButtonLabel(): string
    {
        return static::$formSubmitButtonLabel ?? 'Create';
    }
}
