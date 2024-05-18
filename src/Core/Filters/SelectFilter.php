<?php

namespace Raakkan\Yali\Core\Filters;

class SelectFilter extends Filter
{
    protected $options = [];

    public function apply($builder, $value)
    {
        if (!empty($value)) {
            $builder->whereIn($this->name, $value);
        }
    }

    public function options($options)
    {
        $this->options = $options;
        return $this;
    }

    public function render()
    {
        return view('yali::filters.select');
    }
}
