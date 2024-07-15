<?php

namespace Raakkan\Yali\Core\Database\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Raakkan\Yali\Core\Database\Migrations\YaliMigrator;

class YaliMigrateCommand extends Command
{
    protected $signature = 'yali:migrate';

    public function handle()
    {
        $this->info('Starting Yali migration process...');

        $this->info('Running Laravel migrations...');
        $output = Artisan::output();
        Artisan::call('migrate:fresh');
        $this->line($output);

        $migrator = new YaliMigrator();
        $models = $migrator->collectModels();

        $this->info('Collected models: '.$models->map(function ($model) {
            return basename($model->getFilename(), '.php');
        })->implode(', '));

        foreach ($models as $model) {
            $modelClass = 'App\\Models\\'.basename($model->getFilename(), '.php');
            if (method_exists($modelClass, 'getTranslationTable')) {
                $table = $modelClass::getTranslationTable();
                $this->info("Creating translation table for model: {$modelClass} (Table: {$table->getTable()})");
                $migrator->createTable($table);
            }
        }

        $this->info('Yali migration process completed successfully.');
    }
}
