<?php

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class ForceDeleteAction extends YaliAction
{
    protected string $label = 'Force Delete';

    public function __construct()
    {
        $this->simpleConfirmation();

        $this->action = function ($action, $model, $data) {
            $model->forceDelete();
        };
    }

    public function buttonClasses()
    {
        return [
            ButtonClass::LINK,
            'text-red-500',
        ];
    }

    public function getSuccessMassage(): string
    {
        return $this->getHardDeletedSuccessMessage();
    }
}
