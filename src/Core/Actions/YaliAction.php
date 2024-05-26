<?php

namespace Raakkan\Yali\Core\Actions;
use Raakkan\Yali\Core\Forms\YaliForm;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\Concerns\Stylable;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Resources\YaliResource;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;

abstract class YaliAction extends YaliComponent
{
    use Makable;
    use Stylable;
    use Modalable;
    use HasForm;

    protected string $label;
    protected bool $isLink = false;
    protected bool $isModal = false;

    protected string $route;
    protected Model $model;

    protected YaliResource $resource;

    public function form(YaliForm $form): YaliForm
    {
        return $form;
    }

    public function label($label)
    {
        $this->label = $label;

        return $this;
    }
    
    public function getLabel()
    {
        return $this->label ?? 'Action';
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;

        return $this;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setResource(YaliResource $resource)
    {
        $this->resource = $resource;

        return $this;
    }

    public function link($route)
    {
        $this->route = $route;

        $this->isLink = true;

        return $this;
    }

    public function isLink()
    {
        return $this->isLink;
    }

    public function setLink($link = true)
    {
        $this->isLink = $link;
        return $this;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getUniqueKey()
    {
        return md5(get_class($this) . '_' . uniqid());
    }

    public function getPayload()
    {
        return $this->getModel()->id;
    }

    public function modalable()
    {
        $this->isModal = true;
        return $this;
    }

    public function isModal()
    {
        return $this->isModal;
    }

}
