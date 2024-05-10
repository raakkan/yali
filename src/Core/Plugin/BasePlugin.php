<?php

namespace Raakkan\Yali\Core\Plugin;

use Illuminate\Support\ServiceProvider;
use Raakkan\Yali\Core\Pages\Traits\HasPages;
use Raakkan\Yali\Core\Widgets\Traits\HasWidgets;
use Raakkan\Yali\Core\Settings\Traits\HasSettings;
use Raakkan\Yali\Core\Resources\Traits\HasResources;
use Raakkan\Yali\Core\Plugin\Traits\PluginJsonTrait;
use Raakkan\Yali\Core\Plugin\Interfaces\PluginInterface;

abstract class BasePlugin extends ServiceProvider implements PluginInterface
{
    use PluginJsonTrait;
    use HasResources;
    use HasPages;
    use HasSettings;
    use HasWidgets;

    /**
     * Register the plugin's services.
     *
     * @return void
     */
    public function register()
    {
        // Register the plugin's services
    }

    /**
     * Boot the plugin's services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutes();
        $this->loadViews();
        $this->loadMigrations();
        $this->loadAssets();
    }

    /**
     * Load the plugin's routes.
     *
     * @return void
     */
    public function loadRoutes()
    {
        $this->loadRoutesFrom($this->getPluginPath('routes/web.php'));
    }

    /**
     * Load the plugin's views.
     *
     * @return void
     */
    public function loadViews()
    {
        $this->loadViewsFrom($this->getPluginPath('resources/views'), $this->getName());
    }

    /**
     * Load the plugin's migrations.
     *
     * @return void
     */
    public function loadMigrations()
    {
        $this->loadMigrationsFrom($this->getPluginPath('database/migrations'));
    }

    /**
     * Load the plugin's assets.
     *
     * @return void
     */
    public function loadAssets()
    {
        $this->publishes([
            $this->getPluginPath('resources/assets') => public_path('vendor/' . $this->getName()),
        ], 'assets');
    }

    /**
     * Get the plugin's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->getPluginJson()['name'];
    }

    /**
     * Get the plugin's version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->getPluginJson()['version'];
    }

    /**
     * Get the plugin's description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getPluginJson()['description'];
    }

    /**
     * Get the plugin's dependencies.
     *
     * @return array
     */
    public function getDependencies()
    {
        return $this->getPluginJson()['dependencies'] ?? [];
    }

    /**
     * Get the full path to a specific directory within the plugin.
     *
     * @param string $path
     * @return string
     */
    protected function getPluginPath($path)
    {
        return plugin_path(strtolower($this->getName())) . DIRECTORY_SEPARATOR . $path;
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