<?php

namespace Raakkan\Yali\Core\Resources\Pages;

use Illuminate\Support\Str;
use Raakkan\Yali\Core\Pages\BasePage;
use Raakkan\Yali\Core\Forms\Concerns\InteractsWithForms;

abstract class ResourcePage extends BasePage
{
    use InteractsWithForms;
    protected static $resource;

    protected static $subtitle = '';

    protected static $formSubmitButtonLabel;

    protected static $formUpdatedMessage;

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

    public function submit()
    {
        $validatedData = $this->validatedInputs();

        if (is_null($this->model->{static::getResource()::getModelPrimaryKey()})) {
            $this->model = $this->getForm()->formSubmit($validatedData, $this->model);
            return redirect()->route(static::getResource()::getRouteName() . '.edit', ['record' => $this->model->{static::getResource()::getModelPrimaryKey()}]);
        } else {
            $this->model = $this->getForm()->formSubmit($validatedData, $this->model);
            $this->dispatch('toast', type: 'success', message: static::getFormUpdatedMessage());
        }
    }

    public function getForm()
    {
        $form = $this->getResource()::getForm()->setSubmitButtonLabel($this->getFormSubmitButtonLabel())->setLivewire($this);
        $form->setWireModel('form.'. $form->getId());
        return $form;
    }

    public static function getFormSubmitButtonLabel(): string
    {
        return static::$formSubmitButtonLabel ?? 'Submit';
    }

    public static function getFormUpdatedMessage(): string
    {
        return static::$formUpdatedMessage ?? static::getResource()::getModelName() .' has been updated.';
    }
}