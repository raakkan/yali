<?php

namespace Raakkan\Yali\Core\Actions;
use Raakkan\Yali\Core\View\Link;
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

    public $headerAction = false;

    public function headerAction($headerAction = true)
    {
        $this->headerAction = $headerAction;
        return $this;
    }

    public function isHeaderAction()
    {
        return $this->headerAction;
    }

    public function getButton()
    {
        $button = Button::make();
        $button->classes($this->getClassesArray());
        $button->styles($this->getStylesArray());
        $button->setLabel($this->getLabel());
        return $button;
    }

    public function getLink()
    {
        $link = Link::make();
        $link->classes($this->getClassesArray());
        $link->styles($this->getStylesArray());
        $link->setLabel($this->getLabel());
        
        if($this->hasRouteParam()) {
            $link->setUrl(route($this->getRoute(), $this->getRouteParam()));
        }else {
            $link->setUrl(route($this->getRoute()));
        }

        return $link;
    }
}
