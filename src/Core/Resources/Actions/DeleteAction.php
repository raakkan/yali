<?php

namespace Raakkan\Yali\Core\Resources\Actions;

use Illuminate\Support\Js;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class DeleteAction extends YaliAction
{
    protected string $label = 'Delete';

    public function __construct()
    {
        $this->simpleConfirmation();
    }

    public function buttonClasses()
    {
        return [
            ButtonClass::LINK,
            'text-red-500'
        ];
    }
}
