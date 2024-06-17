<?php

namespace Raakkan\Yali\Core\Table\Concerns;

trait HasModelRecords
{
    public $records;
    public function getRecords()
    {
        return $this->records;
    }

    public function setRecords($records)
    {
        $this->records = $records;

        return $this;
    }
}