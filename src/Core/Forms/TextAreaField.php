<?php

namespace Raakkan\Yali\Core\Forms;

class TextAreaField extends Field
{
    public $rows = 5;
    public $cols = 50;
    public $autoresize = false;

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