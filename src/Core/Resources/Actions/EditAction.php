<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class EditAction extends YaliAction
{
    protected $view = 'yali::actions.action';

    public function __construct() {
        $this->classes([
            ButtonClass::LINK
        ]);
    }

    public function getLabel()
    {
        return $this->label ?? 'Edit';
    }

    public function getModalTitle()
    {
        if ($this->resource) {
            return $this->resource->getUpdatePageTitle();
        }

        return $this->label ?? 'Edit';
    }

    public function getModalSubTitle()
    {
        if ($this->resource) {
            return $this->resource->getSubTitle();
        }

        return $this->label ?? 'Create';
    }

    public function getAlertMessage()
    {
        if ($this->resource) {
            return $this->resource->getUpdatePageMessage();
        }

        return '';
    }

    public function getAlertType()
    {
        if ($this->resource) {
            return $this->resource->getUpdatePageMessageType();
        }

        return '';
    }

    public function getSubmitButtonLabel()
    {
        if ($this->resource) {
            return $this->resource->getUpdateSubmitButtonLabel();
        }

        return 'Submit';
    }

    public function getRoute()
    {
        if ($this->resource) {
            return route($this->resource->getUpdateRouteName(), ['modelKey' => $this->getModel()->id]);
        }

        return '';
    }
}
