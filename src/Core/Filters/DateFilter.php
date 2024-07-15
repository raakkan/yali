<?php

namespace Raakkan\Yali\Core\Filters;

use Illuminate\Database\Eloquent\Builder;

class DateFilter extends Filter
{
    protected $operator;

    public function __construct($name, $operator = '=')
    {
        parent::__construct($name);
        $this->operator = $operator;
    }

    public function apply(Builder $builder, $value)
    {
        return $builder->whereDate($this->name, $this->operator, $value);
    }

    public function render()
    {
        return view('yali::filters.date', [
            'name' => $this->getName(),
            'label' => $this->getLabel(),
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

    }

    public function operator($operator)
    {
        $this->operator = $operator;

        return $this;
    }
}
