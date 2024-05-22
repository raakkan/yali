<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Utils\RouteUtils;
use Raakkan\Yali\Core\Actions\YaliAction;

class EditAction extends YaliAction
{
    protected $view = 'yali::actions.action';

    protected bool $isLink = true;

    protected string $label = 'Edit';

    public function getRoute()
    {
        return route(RouteUtils::getRouteNameByClass(get_class($this->resource)) . '.edit', ['modelKey' => $this->getModel()->id]);
    }
}
