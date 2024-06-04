<?php

namespace Raakkan\Yali\Core\Filters;

use Illuminate\Database\Eloquent\Builder;

class BooleanFilter extends Filter
{
    // TODO: this filter misbehaves when 0 is passed as value like admin and not admin
    protected $trueLabel;
    protected $falseLabel;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->trueLabel = 'Yes';
        $this->falseLabel = 'No';
    }

    public function trueLabel($label)
    {
        $this->trueLabel = $label;
        return $this;
    }

    public function falseLabel($label)
    {
        $this->falseLabel = $label;
        return $this;
    }

    public function apply(Builder $builder, $value)
    {
        return $builder->where($this->name, '=', $value);
    }

    public function render()
    {
        return view('yali::filters.boolean', [
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'trueLabel' => $this->trueLabel,
            'falseLabel' => $this->falseLabel,
            'options' => $this->options(),
        ]);
    }

    public function options()
    {
        return [
            1 => $this->trueLabel,
            0 => $this->falseLabel,
        ];
    }

    public function setValue($value)
    {
        if ($value === '') {
            $this->skip = true;
        } else {
            $this->skip = false;
            $this->value = ($value === '1' || $value === true || $value === 1 || $value === 'true') ? true : false;
        }
        
        return $this;
    }

    public function getValue()
    {
        if (isset($this->value)) {
            return $this->value === true ? 1 : 0;
        }else{
            return '';
        }
    }
}
