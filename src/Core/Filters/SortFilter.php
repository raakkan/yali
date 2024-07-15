<?php

namespace Raakkan\Yali\Core\Filters;

use Illuminate\Database\Eloquent\Builder;

class SortFilter extends Filter
{
    protected $ascLabel;

    protected $descLabel;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->ascLabel = 'Ascending';
        $this->descLabel = 'Descending';
    }

    public function ascLabel($label)
    {
        $this->ascLabel = $label;

        return $this;
    }

    public function descLabel($label)
    {
        $this->descLabel = $label;

        return $this;
    }

    public function apply(Builder $builder, $value)
    {
        return $builder->orderBy($this->name, $value);
    }

    public function render()
    {
        return view('yali::filters.sort', [
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'ascLabel' => $this->ascLabel,
            'descLabel' => $this->descLabel,
            'options' => $this->options(),
        ]);
    }

    public function options()
    {
        return [
            'asc' => $this->ascLabel,
            'desc' => $this->descLabel,
        ];
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

    public function getValue()
    {
        return $this->value ?? '';
    }
}
