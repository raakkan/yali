<?php

namespace Raakkan\Yali\Core\Forms\Wizard;

use Illuminate\Support\Collection;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\View\YaliComponent;

class Wizard extends YaliComponent
{
    use Makable;

    protected $componentName = 'wizard';

    protected $view = 'yali::forms.wizard.wizard';

    protected $steps = [];

    public function __construct(array $steps = [])
    {
        $this->steps = $steps;
    }

    public function addStep(Step $step)
    {
        $this->steps[] = $step;
    }

    public function getSteps()
    {
        return Collection::make($this->steps);
    }

    public function setWizardSteps($steps)
    {
        dd($steps);
    }
}
