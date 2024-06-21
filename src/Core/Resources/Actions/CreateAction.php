<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;
use Raakkan\Yali\Core\Actions\YaliAction;

class CreateAction extends YaliAction
{
    protected $buttonIsLink = true;
    public $headerAction = true;

    public function __construct()
    {
        $this->action = function ($model, $data) {
            foreach ($data as $key => $value) {
                $model->$key = $value;
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
            ButtonClass::SMALL
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
