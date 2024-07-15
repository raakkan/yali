<?php

namespace Raakkan\Yali\Core\Forms\Fields;

class TextareaField extends Field
{
    protected $view = 'yali::forms.fields.textarea-field';

    public $rows = 5;

    public $cols = 50;

    public $autoresize = true;

    public function cols($cols)
    {
        $this->cols = $cols;

        return $this;
    }

    public function rows($rows)
    {
        $this->rows = $rows;

        return $this;
    }

    public function autoresize($autoresize)
    {
        $this->autoresize = $autoresize;

        return $this;
    }
}
