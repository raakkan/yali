<?php 

namespace Raakkan\Yali\Core\Resources\Table;

use Illuminate\Support\Str;

class TableColumn
{
    public $name;

    public $label;

    public static function make($name)
    {
        return new static($name);
    }

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel()
    {
        return $this->label ?: Str::title(str_replace('_','', $this->name));
    }

    public function getName()
    {
        return $this->name;
    }
}
