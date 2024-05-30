<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;
use Raakkan\Yali\Core\Actions\YaliAction;

class CreateAction extends YaliAction
{
    protected $view = 'yali::actions.action';

    public function __construct() {
        $this->classes([
            ButtonClass::BTN,
            ButtonClass::PRIMARY,
            ButtonClass::SMALL
        ]);
    }

    public function getLabel()
    {
        if (isset($this->source) && $this->source) {
            return $this->source->getCreatePageTitle();
        }

        return $this->label ?? 'Create';
    }

    public function getModalTitle()
    {
        if (isset($this->source) && $this->source) {
            return $this->source->getCreatePageTitle();
        }

        return $this->label ?? 'Create';
    }

    public function getModalSubTitle()
    {
        if (isset($this->source) && $this->source) {
            return $this->source->getCreatePageSubTitle();
        }

        return '';
    }

    public function getAlertMessage()
    {
        if (isset($this->source) && $this->source) {
            return $this->source->getCreatePageMessage();
        }

        return '';
    }

    public function getAlertType()
    {
        if (isset($this->source) && $this->source) {
            return $this->source->getCreatePageMessageType();
        }

        return '';
    }

    public function getSubmitButtonLabel()
    {
        if (isset($this->source) && $this->source) {
            return $this->source->getCreateSubmitButtonLabel();
        }

        return 'Submit';
    }

    public function getRoute()
    {
        if (isset($this->source) && $this->source) {
            return route($this->source->getCreateRouteName());
        }

        return '';
    }

    public function getCreatedSuccessMessage()
    {
        return $this->source->getCreatedSuccessMessage();
    }
}
