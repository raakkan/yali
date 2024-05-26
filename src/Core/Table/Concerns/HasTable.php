<?php

namespace Raakkan\Yali\Core\Table\Concerns;

use Raakkan\Yali\Core\Table\YaliTable;

trait HasTable
{
    protected $table;

    abstract public function table(YaliTable $table): YaliTable;

    public function getTable()
    {
        if(!$this->table) {
            $this->table = new YaliTable();
        }
        return $this->table;
    }
}