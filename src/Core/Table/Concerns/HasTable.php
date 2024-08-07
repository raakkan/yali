<?php

namespace Raakkan\Yali\Core\Table\Concerns;

use Raakkan\Yali\Core\Table\YaliTable;

trait HasTable
{
    protected static $table;

    public static function table(YaliTable $table): YaliTable
    {
        return $table;
    }

    public static function getTable()
    {
        if (! static::$table) {
            static::$table = YaliTable::make();
            static::$table->setSource(static::class);
        }

        return static::table(static::$table);
    }
}
