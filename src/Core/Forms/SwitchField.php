<?php

namespace Raakkan\Yali\Core\Forms;

class SwitchField extends Field
{
    protected $view = 'yali::forms.fields.switch-field';
    protected $type = 'switch';

    public function checked($checked = true)
    {
        $this->default = $checked;
        return $this;
    }
}
