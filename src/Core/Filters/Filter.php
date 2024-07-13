<?php

namespace Raakkan\Yali\Core\Filters;

use Closure;

use Illuminate\Database\Eloquent\Builder;
use Raakkan\Yali\Core\Support\Concerns\Makable;

abstract class Filter
{
    use Makable;

    public $name;
    protected $label;
    protected $value;

    public $skip = false;

    public $hidden = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function hidden($hidden = true)
    {
        $this->hidden = $hidden;
        return $this;
    }

    public function isHidden()
    {
        return $this->hidden;
    }

    abstract public function apply(Builder $builder, $value);

    abstract public function render();
    abstract public function setValue($value);

    public function handle(Builder $builder, Closure $next)
    {
        if (!is_null($this->value)) {
            return $this->apply($builder, $this->value);
        }

        return $next($builder);
    }
}
