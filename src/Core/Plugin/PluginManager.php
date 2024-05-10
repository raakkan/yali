<?php

namespace Raakkan\Yali\Core\Plugin;

use RegexIterator;
use RecursiveRegexIterator;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Raakkan\Yali\Core\Plugin\BasePlugin;
use Raakkan\Yali\Core\Plugin\PluginConfigHelper;

class PluginManager
{
    protected $app;

    /**
     * The registered plugins.
     *
     * @var array
     */
    protected $plugins = [];

    public function __construct($app) {
       $this->app = $app;
    }

    /**
     * Register a plugin.
     *
     * @param BasePlugin $plugin
     * @return void
     */
    public function register(BasePlugin $plugin)
    {
        $this->plugins[] = $plugin;
    }

    /**
     * Get the registered plugins.
     *
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }

    /**
     * Boot the registered plugins.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->getPlugins() as $plugin) {
            $this->app->register($plugin);
            $this->app->make(PluginConfigHelper::class)->addPluginConfig($plugin->getName());
        }
    }

    /**
     * Discover plugins in the given directory.
     *
     * @param string $directory
     * @return void
     */
    public function discoverPlugins($directory)
    {
        $directoryIterator = new RecursiveDirectoryIterator($directory);
        $iterator = new RecursiveIteratorIterator($directoryIterator);
        $regexIterator = new RegexIterator($iterator, '/^.+?Plugin.php$/i', RecursiveRegexIterator::GET_MATCH);

        foreach ($regexIterator as $file) {
            $filePath = $file[0];
            $directoryPath = dirname($filePath);
            $jsonPath = $directoryPath . DIRECTORY_SEPARATOR . 'plugin.json';

            if (!file_exists($jsonPath)) {
                continue;
            }

            $json = json_decode(file_get_contents($jsonPath), true);
            if (empty($json)) {
                continue;
            }

            $className = $json['namespace'] . '\\' . basename($filePath, '.php');
            if (!class_exists($className)) {
                require_once $filePath;
            }

            $plugin = new $className(app());
            $plugin->setPluginJson($json);

            $this->register($plugin);
        }
    }
}
