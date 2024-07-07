<?php

namespace Raakkan\Yali\Core\Concerns\Database;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Database\Migrations\YaliTable;
use Raakkan\Yali\Core\Support\Facades\YaliLog;

trait HasTranslations
{
    public static function bootHasTranslations()
    {
    }

    public function getAttribute($attributeName)
    {
        if ($this->isTranslatableAttribute($attributeName)) {
            return $this->getTranslation($attributeName, App::getLocale());
        }

        return parent::getAttribute($attributeName);
    }

    public function getTranslation($attributeName, $locale)
    {
        $yaliTable = static::getTranslationTable();

        if (!Schema::hasTable($yaliTable->getTable())) {
            YaliLog::warning('Translation table not found: ' . $yaliTable->getTable());
            return null;
        }

        $translation = DB::table($yaliTable->getTable())
            ->where('locale', $locale)
            ->where($this->getParentKey(), $this->getKey())
            ->first();
            
        return $translation ? $translation->$attributeName : null;
    }

    public function setTranslation($locale, $data)
    {
        $yaliTable = static::getTranslationTable();

        if (!Schema::hasTable($yaliTable->getTable())) {
            YaliLog::warning('Translation table not found: ' . $yaliTable->getTable());
            return;
        }

        $translation = DB::table($yaliTable->getTable())
            ->where('locale', $locale)
            ->where($this->getParentKey(), $this->getKey())
            ->first();

        if ($translation) {
            DB::table($yaliTable->getTable())
                ->where('id', $translation->id)
                ->update($data);
        } else {
            DB::table($yaliTable->getTable())->insert([
                'locale' => $locale,
                $this->getParentKey() => $this->getKey(),
                ...$data
            ]);
        }
    }

    private function isTranslatableAttribute($attributeName)
    {
        return in_array($attributeName, $this->getTranslatableAttributes());
    }

    public function getTranslatableAttributes()
    {
        return static::getTranslationTable()->getColumnsNames();
    }

    public function getParentKey()
    {
        $modelTable = $this->getTable();
        $modelTableSingular = Str::singular($modelTable);
        $modelKeyName = $this->getKeyName();

        return "{$modelTableSingular}_{$modelKeyName}";
    }
}
