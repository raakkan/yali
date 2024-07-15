<?php

namespace Raakkan\Yali\Core\Filters;

use Illuminate\Database\Eloquent\Builder;

class SelectFilter extends Filter
{
    protected $options = [];

    public function options(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function apply(Builder $builder, $value)
    {
        return $builder->where($this->name, '=', $value);
    }

    public function render()
    {
        return view('yali::filters.select', [
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'options' => $this->getOptions(),
            'value' => $this->getValue(),
        ]);
    }

    public function setValue($value)
    {
        if ($value === '') {
            $this->skip = true;
        } else {
            $this->skip = false;
            $this->value = $value;
        }

        return $this;
    }
}
