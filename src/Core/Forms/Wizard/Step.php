<?php

namespace Raakkan\Yali\Core\Forms\Wizard;

use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\View\YaliComponent;

class Step extends YaliComponent
{
    use Makable;
    protected $componentName = 'step';
    protected $view = 'yali::forms.wizard.step';
}
