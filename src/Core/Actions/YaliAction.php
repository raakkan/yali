<?php

namespace Raakkan\Yali\Core\Actions;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Actions\Concerns\HasLink;
use Raakkan\Yali\Core\Actions\Concerns\HasLabel;
use Raakkan\Yali\Core\Actions\Concerns\HasWizard;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;
use Raakkan\Yali\Core\Concerns\Database\HasModel;
use Raakkan\Yali\Core\Concerns\Components\HasButton;
use Raakkan\Yali\Core\Actions\Concerns\HasHeaderActions;

abstract class YaliAction extends YaliComponent
{
    use Makable;
    use Stylable;
    use Modalable;
    use HasLabel;
    use HasLink;
    use HasButton;
    use HasModel;
    use HasHeaderActions;
    use HasWizard;

    protected $componentName = 'action';

    protected $view = 'yali::actions.action';

    protected $livewireComponent;

    public function buttonAttributes()
    {
        return [
            'wire:key' => 'action-button-'. $this->getUniqueKey(),
        ];
    }

    public function getLivewireComponent()
    {
        return $this->livewireComponent;
    }

    public function setLivewireComponent($livewireComponent)
    {
        $this->livewireComponent = $livewireComponent;

        return $this;
    }
}
