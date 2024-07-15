<?php

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class CreateAction extends YaliAction
{
    protected $buttonIsLink = true;

    public $headerAction = true;

    public function __construct()
    {
        $this->action = function ($action, $model, $form) {
            $fields = $form->getFields();

            foreach ($fields as $field) {
                $fieldName = $field->getName();

                if (! $field->hasRelationship()) {
                    $model->$fieldName = $field->getValue();
                }
            }

            $model->save();

            return $model;
        };
    }

    public function buttonClasses()
    {
        return [
            ButtonClass::BTN,
            ButtonClass::PRIMARY,
            ButtonClass::SMALL,
        ];
    }

    public function getButtonUrl()
    {
        return $this->getRoute();
    }

    public function getLabel()
    {
        return $this->label ?? 'Create';
    }

    public function getSuccessMassage(): string
    {
        return $this->getCreatedSuccessMessage();
    }
}
