<?php

namespace Raakkan\Yali\Core\Actions;
use Illuminate\Support\Js;
use Raakkan\Yali\Core\Concerns\Components\HasButton;
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
    use HasButton;

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

    public function buttonAttributes()
    {
        return array_merge($this->getButton()->getAttributes(), [
            'wire:key' => 'action-button-'. $this->getUniqueKey(),
        ]);
    }
}
