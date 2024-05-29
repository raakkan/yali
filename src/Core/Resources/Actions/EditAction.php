<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Utils\RouteUtils;
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
            return $this->resource->getEditTitle();
        }

        return $this->label ?? 'Edit';
    }

    public function getRoute()
    {
        return route(RouteUtils::getRouteNameByClass(get_class($this->resource)) . '.edit', ['modelKey' => $this->getModel()->id]);
    }
}
