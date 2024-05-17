<?php

namespace Raakkan\Yali\Core\Resources\Table;

use Illuminate\Support\Str;

class TextColumn extends TableColumn
{
    public $type = 'text';

    public function prepend($prefix)
    {
        $this->renderCallback = function ($data) use ($prefix) {
            $text = $this->limitLength ? Str::limit($data[$this->getName()], $this->limitLength) : $data[$this->getName()];
            return $prefix . $text;
        };

        return $this;
    }

    public function append($suffix)
    {
        $this->renderCallback = function ($data) use ($suffix) {
            $text = $this->limitLength ? Str::limit($data[$this->getName()], $this->limitLength) : $data[$this->getName()];
            return $text . $suffix;
        };

        return $this;
    }
}
