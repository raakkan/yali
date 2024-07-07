<?php

namespace Raakkan\Yali\Core\Resources\Pages;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;

class EditPage extends ResourcePage
{
    protected static $view = 'yali::resources.pages.edit-page';
    protected static $title = 'Edit';

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
        // TODO: Implement fail on record not found exception
        $this->model = $this->getResource()::getModel()->findOrFail($record);
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

    public static function isHidden(): bool
    {
        return true;
    }
}