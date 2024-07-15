<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

use Raakkan\Yali\Core\Forms\YaliForm;

trait HasForm
{
    protected static $form;

    public static function form(YaliForm $form): YaliForm
    {
        return $form;
    }

    public static function getForm()
    {
        if (! static::$form) {
            static::$form = YaliForm::make();
        }

        return static::form(static::$form);
    }

    public function setForm(YaliForm $form)
    {
        static::$form = $form;

        return $this;
    }
}
