<?php
if (! function_exists('plugin_path')) {
    function plugin_path($plugin_name = '')
    {
        $path = base_path('plugins/'.$plugin_name);
        if (!is_dir($path)) {
            throw new InvalidArgumentException("Plugin path {$path} does not exist");
        }

        return $path;
    }
}

if (! function_exists('plugin_database_path')) {
    function plugin_database_path($plugin_name = '')
    {
        return database_path('plugins/'.$plugin_name);
    }
}