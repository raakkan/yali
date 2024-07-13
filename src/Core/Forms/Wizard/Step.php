<?php

namespace Raakkan\Yali\Core\Forms\Wizard;

use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Support\Concerns\Makable;

class Step extends YaliComponent
{
    use Makable;
    protected $componentName = 'step';
    protected $view = 'yali::forms.wizard.step';
}
