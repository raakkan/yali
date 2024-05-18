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
        $builder->where($this->getName(), $value);
    }

    public function render()
    {
        return view('yali::filters.select', [
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'value' => $this->getValue(),
            'options' => $this->getOptions(),
        ]);
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}
