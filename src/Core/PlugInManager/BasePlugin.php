<?php 

namespace Raakkan\Yali\Core\PlugInManager;

use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\PlugInManager\Traits\PluginJsonTrait;

abstract class BasePlugin extends ServiceProvider
{
    use PluginJsonTrait;

     /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}

// $migrationFiles = glob(database_path('migrations/*.php'));

//         foreach ($migrationFiles as $file) {
//             include_once $file;

//             $migrationClass = basename($file, '.php');
//             $migrationInstance = new $migrationClass();

//             if ($migrationInstance instanceof Migration) {
//                 $upMethod = new ReflectionMethod($migrationClass, 'up');
//                 $upMethod->invoke($migrationInstance);

//                 // Check if the table exists
//                 if (Schema::hasTable($migrationInstance->getTableName())) {
//                     echo "Table '{$migrationInstance->getTableName()}' exists." . PHP_EOL;
//                 } else {
//                     echo "Table '{$migrationInstance->getTableName()}' does not exist." . PHP_EOL;
//                 }
//             }
//         }