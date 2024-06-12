<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;
use Raakkan\Yali\Core\Actions\YaliAction;

class CreateAction extends YaliAction
{
    protected $view = 'yali::actions.action';

    protected $buttonIsLink = true;

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

    public function getSubmitButtonLabel()
    {
        return 'Submit';
    }
}
