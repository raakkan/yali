<?php

namespace Raakkan\Yali\Core\Database\Migrations;
use Raakkan\Yali\Core\Concerns\Makable;

class YaliColumn
{
    use Makable;

    public $name;
    public $isString;
    public $isRequired;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function string()
    {
        $this->isString = true;
        return $this;
    }

    public function required()
    {
        $this->isRequired = true;
        return $this;
    }

    public function toSql()
    {
        $sql = $this->name;
        if ($this->isString) {
            $sql .= ' VARCHAR(255)';
        }
        if ($this->isRequired) {
            $sql .= ' NOT NULL';
        }
        return $sql;
    }
}
