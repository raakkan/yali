<?php

namespace Raakkan\Yali\Core\Actions;
use Raakkan\Yali\Core\View\Button;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Actions\Concerns\HasLink;
use Raakkan\Yali\Core\Actions\Concerns\HasLabel;
use Raakkan\Yali\Core\Actions\Concerns\HasSource;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;
use Raakkan\Yali\Core\Concerns\Database\HasModel;

abstract class YaliAction extends YaliComponent
{
    use Makable;
    use Stylable;
    use Modalable;
    use HasLabel;
    use HasLink;
    use HasSource;

    protected $model;

    public function getAlertMessage()
    {
        return '';
    }

    public function getAlertType()
    {
        return '';
    }

    public function getPayload()
    {
        return $this->getModel()->id;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getButton()
    {
        $button = Button::make();
        $button->classes($this->getClassesArray());
        $button->styles($this->getStylesArray());
        $button->setLabel($this->getLabel());
        return $button;
    }
}
