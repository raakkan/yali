<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

use Raakkan\Yali\Core\Forms\Fields\SelectField;
use Raakkan\Yali\Core\Forms\Fields\TextareaField;
use Raakkan\Yali\Core\Forms\Fields\TextField;

trait HasSettingTypes
{
    protected $type = 'text';

    public $inputField;

    public $inputFieldCallback;

    public function getType()
    {
        return $this->type;
    }

    public function customizeInputField($callback)
    {
        $this->inputFieldCallback = $callback;

        return $this;
    }

    public function getInputField()
    {
        if ($this->inputFieldCallback) {
            call_user_func($this->inputFieldCallback, $this->inputField);
        }

        return $this->inputField->setWireModel('settings.'.$this->source.'.'.$this->group.'.'.$this->name);
    }

    public function text()
    {
        $this->inputField = TextField::make($this->name);
        $this->type = 'text';

        return $this;
    }

    public function textarea()
    {
        $this->inputField = TextareaField::make($this->name);
        $this->type = 'textarea';

        return $this;
    }

    public function select()
    {
        $this->inputField = SelectField::make($this->name);
        $this->type = 'select';

        return $this;
    }

    public function number()
    {
        $this->type = 'number';

        return $this;
    }

    public function email()
    {
        $this->type = 'email';

        return $this;
    }

    public function password()
    {
        $this->type = 'password';

        return $this;
    }

    public function checkbox()
    {
        $this->type = 'checkbox';

        return $this;
    }

    public function radio()
    {
        $this->type = 'radio';

        return $this;
    }

    public function file()
    {
        $this->type = 'file';

        return $this;
    }

    public function image()
    {
        $this->type = 'image';

        return $this;
    }

    public function color()
    {
        $this->type = 'color';

        return $this;
    }

    public function date()
    {
        $this->type = 'date';

        return $this;
    }

    public function time()
    {
        $this->type = 'time';

        return $this;
    }

    public function datetime()
    {
        $this->type = 'datetime';

        return $this;
    }

    public function week()
    {
        $this->type = 'week';

        return $this;
    }

    public function month()
    {
        $this->type = 'month';

        return $this;
    }

    public function year()
    {
        $this->type = 'year';

        return $this;
    }

    public function range()
    {
        $this->type = 'range';

        return $this;
    }

    public function colorPicker()
    {
        $this->type = 'color-picker';

        return $this;
    }

    public function fileUpload()
    {
        $this->type = 'file-upload';

        return $this;
    }

    public function imageUpload()
    {
        $this->type = 'image-upload';

        return $this;
    }
}
