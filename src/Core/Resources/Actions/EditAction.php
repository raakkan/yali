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
        if ($this->source) {
            return $this->source->getUpdatePageTitle();
        }

        return $this->label ?? 'Edit';
    }

    public function getModalSubTitle()
    {
        if ($this->source) {
            return $this->source->getUpdatePageSubTitle();
        }

        return $this->label ?? '';
    }

    public function getAlertMessage()
    {
        if ($this->source) {
            return $this->source->getUpdatePageMessage();
        }

        return '';
    }

    public function getAlertType()
    {
        if ($this->source) {
            return $this->source->getUpdatePageMessageType();
        }

        return '';
    }

    public function getSubmitButtonLabel()
    {
        if ($this->source) {
            return $this->source->getUpdateSubmitButtonLabel();
        }

        return 'Submit';
    }

    public function getRoute()
    {
        if ($this->source) {
            return route($this->source->getUpdateRouteName(), ['modelKey' => $this->getModel()->id]);
        }

        return '';
    }

    public function getUpdatedSuccessMessage()
    {
        return $this->source->getUpdatedSuccessMessage();
    }
}
