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
        if (isset($this->resource) && $this->resource) {
            return $this->resource->getCreatePageTitle();
        }

        return $this->label ?? 'Create';
    }

    public function getModalTitle()
    {
        if (isset($this->resource) && $this->resource) {
            return $this->resource->getCreatePageTitle();
        }

        return $this->label ?? 'Create';
    }

    public function getModalSubTitle()
    {
        if (isset($this->resource) && $this->resource) {
            return $this->resource->getSubTitle();
        }

        return '';
    }

    public function getAlertMessage()
    {
        if (isset($this->resource) && $this->resource) {
            return $this->resource->getCreatePageMessage();
        }

        return '';
    }

    public function getAlertType()
    {
        if (isset($this->resource) && $this->resource) {
            return $this->resource->getCreatePageMessageType();
        }

        return '';
    }

    public function getSubmitButtonLabel()
    {
        if (isset($this->resource) && $this->resource) {
            return $this->resource->getCreateSubmitButtonLabel();
        }

        return 'Submit';
    }

    public function getRoute()
    {
        if (isset($this->resource) && $this->resource) {
            return route($this->resource->getCreateRouteName());
        }

        return '';
    }
}
