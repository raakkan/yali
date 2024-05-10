<?php

namespace Raakkan\Yali\Core\Plugin;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class PluginConfigHelper
{
    protected $configPath;

    public function __construct()
    {
        $this->configPath = __DIR__ . '/../../../plugins.php'; // Centralized path to the config file
        $this->ensureConfigExists();
    }

    /**
     * Ensure the plugin configuration file exists.
     */
    protected function ensureConfigExists()
    {
        if (!file_exists($this->configPath)) {
            $this->savePluginsConfig([]); // Initialize with an empty array if the file does not exist
        }
    }

    /**
     * Get all active plugins from the configuration.
     */
    public function getActivePlugins()
    {
        $plugins = $this->getAllPlugins();
        return array_filter($plugins, function ($details) {
            return Arr::get($details, 'active', false);
        });
    }

    /**
     * Get all plugins from the configuration.
     */
    public function getAllPlugins()
    {
        return include($this->configPath);
    }

    /**
     * Activate a plugin by key.
     */
    public function activatePlugin($key)
    {
        $plugins = $this->getAllPlugins();
        if (isset($plugins[$key])) {
            $plugins[$key]['active'] = true;
            $this->savePluginsConfig($plugins);
        }
    }

    /**
     * Deactivate a plugin by key.
     */
    public function deactivatePlugin($key)
    {
        $plugins = $this->getAllPlugins();
        if (isset($plugins[$key])) {
            $plugins[$key]['active'] = false;
            $this->savePluginsConfig($plugins);
        }
    }

    /**
     * Save the updated plugins configuration.
     */
    protected function savePluginsConfig($config)
    {
        $configExport = '<?php return ' . var_export($config, true) . ';';
        file_put_contents($this->configPath, $configExport);
    }

    /**
     * Add a new plugin configuration using only the plugin key.
     *
     * @param string $key The plugin key.
     */
    public function addPluginConfig($key)
    {
        $config = $this->getAllPlugins();
    
        // Check if the plugin configuration already exists
        if (!isset($config[$key])) {
            // Default configuration for a new plugin
            $defaultConfig = [
                'active' => false, // Default to inactive
                'settings' => []  // Maintain settings structure even if not used
            ];
    
            // Update the plugins array with the new plugin config
            $config[$key] = $defaultConfig;
    
            // Save the updated configuration
            $this->savePluginsConfig($config);
        } else {
            // If the plugin already exists, you might want to update the active state or other properties
            // For example, to reactivate an inactive plugin, you could set:
            // $config[$key]['active'] = true;
            // Save the updated configuration if any changes are made
            $this->savePluginsConfig($config);
        }
    
        return $config;
    }
    
}
