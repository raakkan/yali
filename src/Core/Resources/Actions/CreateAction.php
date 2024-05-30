<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;
use Raakkan\Yali\Core\Utils\RouteUtils;
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
        if ($this->resource) {
            return $this->resource->getCreatePageTitle();
        }

        return $this->label ?? 'Create';
    }

    public function getModalTitle()
    {
        if ($this->resource) {
            return $this->resource->getCreatePageTitle();
        }

        return $this->label ?? 'Create';
    }

    public function getAlertMessage()
    {
        if ($this->resource) {
            return $this->resource->getCreatePageMessage();
        }

        return '';
    }

    public function getAlertType()
    {
        if ($this->resource) {
            return $this->resource->getCreatePageMessageType();
        }

        return '';
    }

    public function getSubmitButtonLabel()
    {
        if ($this->resource) {
            return $this->resource->getCreateSubmitButtonLabel();
        }

        return 'Submit';
    }

    public function getRoute()
    {
        return route(RouteUtils::getRouteNameByClass(get_class($this->resource)) . '.create');
    }
}
