<?php

namespace Raakkan\Yali\Core\Database\Migrations;

use Illuminate\Support\Str;
use Raakkan\Yali\Models\YaliModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class YaliMigrator
{
    public function collectModels()
    {
        $models = File::allFiles(base_path('app/Models'));

        $yaliModels = collect($models)->filter(function ($model) {
            $modelClass = 'App\\Models\\' . basename($model->getFilename(), '.php');

            return is_subclass_of($modelClass, YaliModel::class);
        });

        return $yaliModels;
    }

    public function createTable($yaliTable)
    {
        if (!Schema::hasTable($yaliTable->getTable())) {
            Schema::create($yaliTable->getTable(), function ($table) use ($yaliTable) {
                $table->id();

                $model = $yaliTable->getCallerClass();
                if ($model) {
                    $model = new $model();
                    $modelTable = $model->getTable();
                    $modelTableSingular = Str::singular($modelTable);
                    $modelKeyName = $model->getKeyName();
                    $table->unsignedBigInteger("{$modelTableSingular}_{$modelKeyName}");
                    $table->foreign("{$modelTableSingular}_{$modelKeyName}")->references($modelKeyName)->on($modelTable)->onDelete('cascade');
                }

                $table->string('locale');

                foreach ($yaliTable->getColumns() as $column) {
                    $columnName = $column->name;
                    if ($column->isString) {
                        $table->string($columnName, 255)->nullable(!$column->isRequired);
                    } else {
                        // Add other column types as needed
                    }
                }
                if ($yaliTable->getTimestamps()) {
                    $table->timestamps();
                }
            });
        }
    }

}
