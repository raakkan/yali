<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

if (!function_exists('plugin_path')) {
    /**
     * Get the path to the specified plugin.
     *
     * @param string $plugin
     * @return string
     */
    function plugin_path($plugin = null)
    {
        $filesystem = new Filesystem();
        $pluginsPath = base_path('plugins');

        if (is_null($plugin)) {
            return $pluginsPath;
        }

        $pluginPath = $pluginsPath . '/' . $plugin;
        
        if (!$filesystem->isDirectory($pluginPath)) {
            throw new InvalidArgumentException("Plugin [{$plugin}] does not exist.");
        }

        return $pluginPath;
    }
}