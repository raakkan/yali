<?php

namespace Raakkan\Yali\Core\Actions;
use Raakkan\Yali\Core\View\Button;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Pages\YaliPage;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Resources\YaliResource;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;

abstract class YaliAction extends YaliComponent
{
    use Makable;
    use Stylable;
    use Modalable;

    protected string $label;
    protected bool $isLink = false;
    protected string $route;
    protected Model $model;

    protected YaliResource | YaliPage $source;

    public function label($label)
    {
        $this->label = $label;

        return $this;
    }
    
    public function getLabel()
    {
        return $this->label ?? 'Action';
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getAlertMessage()
    {
        return '';
    }

    public function getAlertType()
    {
        return '';
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

    public function getSource()
    {
        return $this->source;
    }

    public function setSource(YaliResource | YaliPage $source)
    {
        $this->source = $source;

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

    public function getPayload()
    {
        return $this->getModel()->id;
    }

    public function getButton()
    {
        $button = Button::make();
        $button->classes($this->getClassesArray());
        $button->styles($this->getStylesArray());
        $button->setLabel($this->getLabel());
        return $button;
    }

    public function getSourceClass()
    {
        return $this->getSource()->getClass();
    }

}
