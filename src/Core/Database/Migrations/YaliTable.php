<?php

namespace Raakkan\Yali\Core\Database\Migrations;

use Raakkan\Yali\Core\Support\Concerns\Makable;

class YaliTable
{
    use Makable;

    protected $table = '';

    protected $columns = [];

    protected $additionalColumns = [];

    protected $primaryKey = 'id';

    protected $timestamps = true;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function columns($columns)
    {
        $this->columns = $columns;

        return $this;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getColumnsNames()
    {
        $names = [];
        foreach ($this->getColumns() as $column) {
            $names[] = $column->name;
        }

        return $names;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function getTimestamps()
    {
        return $this->timestamps;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function toSql()
    {
        $sql = $this->table;
        foreach ($this->getColumns() as $column) {
            $sql .= ' '.$column->toSql();
        }

        return $sql;
    }
}
