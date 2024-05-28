<?php

namespace Raakkan\Yali\Core\Forms\Fields;

class ToggleField extends Field
{
    protected $view = 'yali::forms.fields.switch-field';
    protected $type = 'switch';

    public function checked($checked = true)
    {
        $this->default = $checked;
        return $this;
    }
}
