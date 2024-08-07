<?php

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class EditAction extends YaliAction
{
    protected $buttonIsLink = true;

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
            ButtonClass::LINK,
        ];
    }

    public function getButtonUrl()
    {
        $this->setRouteParameters(['record' => $this->getModelIdentifier()]);

        return $this->getRoute();
    }

    public function getLabel()
    {
        return $this->label ?? 'Edit';
    }

    public function getSuccessMassage(): string
    {
        return $this->getUpdatedSuccessMessage();
    }
}
