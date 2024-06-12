<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class EditAction extends YaliAction
{
    protected $view = 'yali::actions.action';

    protected $buttonIsLink = true;

    public function buttonClasses()
    {
        return [
            ButtonClass::LINK
        ];
    }

    public function getButtonUrl()
    {
        $this->setRouteParameters(['record' => $this->getModel()->{$this->getModelPrimaryKey()}]);
        return $this->getRoute();
    }

    public function getLabel()
    {
        return $this->label ?? 'Edit';
    }

    public function getSubmitButtonLabel()
    {
        return 'Submit';
    }
}
