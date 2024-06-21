<?php

namespace Raakkan\Yali\Core\Resources\Actions;

use Illuminate\Support\Js;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class ForceDeleteAction extends YaliAction
{
    protected string $label = 'Force Delete';

    public function __construct()
    {
        $this->simpleConfirmation();

        $this->action = function ($model) {
            $model->forceDelete();
        };
    }

    public function buttonClasses()
    {
        return [
            ButtonClass::LINK,
            'text-red-500'
        ];
    }
}
