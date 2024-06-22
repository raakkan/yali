<?php

namespace Raakkan\Yali\Core\Forms\Fields;

class SelectField extends Field
{
    protected $view = 'yali::forms.fields.select-field';
    protected $options = [];

    public function options($options)
    {
        if (!is_array($options) && !is_callable($options)) {
            throw new \InvalidArgumentException('Options must be an array or a callable');
        }

        $this->options = $options;
        return $this;
    }

    public function getOptions()
    {
        if (is_callable($this->options)) {
            return call_user_func($this->options);
        }

        return $this->options;
    }
}
