<?php

namespace Raakkan\Yali\Core\Actions\Concerns;

use Raakkan\Yali\Core\Forms\Wizard\Step;
use Raakkan\Yali\Core\Forms\Wizard\Wizard;

trait HasWizard
{
    public function getWizard()
    {
        return Wizard::make([
            Step::make(),
            Step::make(),
        ]);
    }
}
