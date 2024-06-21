<?php

namespace Raakkan\Yali\Core\Resources\Actions;

use Illuminate\Support\Js;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class RestoreAction extends YaliAction
{
    protected string $label = 'Restore';

    public function __construct()
    {
        $this->action = function ($model) {
            $model->restore();
        };
    }

    public function buttonClasses()
    {
        return [
            ButtonClass::LINK
        ];
    }

    public function buttonAttributes()
    {
        return [
            'wire:key' => 'action-button-'. $this->getUniqueKey(),
            'wire:click' => 'excuteAction(' . Js::from($this->getClassName())->toHtml() . ', ' . $this->getModelIdentifier() . ')',
        ];
    }
}
