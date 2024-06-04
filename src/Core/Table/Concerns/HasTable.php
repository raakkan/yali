<?php

namespace Raakkan\Yali\Core\Table\Concerns;

use Raakkan\Yali\Core\Table\YaliTable;

trait HasTable
{
    private $table;

    public function table(YaliTable $table): YaliTable
    {
        return $table;
    }

    public function getTable()
    {
        if(!$this->table) {
            $this->table = new YaliTable();
        }
        return $this->table;
    }
}