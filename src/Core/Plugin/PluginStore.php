<?php

namespace Raakkan\Yali\Core\Plugin;

use Raakkan\Yali\Core\Plugin\Dtos\Plugin;
use Raakkan\Yali\Core\Plugin\PluginConfigHelper;

class PluginStore
{
    protected $pluginConfigHelper;

    public function __construct(PluginConfigHelper $pluginConfigHelper)
    {
        $this->pluginConfigHelper = $pluginConfigHelper;
    }

    public function getPlugins()
    {
        $pluginConfigs = $this->pluginConfigHelper->getAllPlugins();
        $plugins = [];

        foreach ($pluginConfigs as $key => $config) {
            $plugin = new Plugin();
            $plugin->name = $config['name'] ?? null;
            $plugin->version = $config['version'] ?? null;
            $plugin->description = $config['description'] ?? null;
            $plugin->author = $config['author'] ?? null;
            $plugin->active = $config['active'] ?? false;
            $plugin->path = plugin_path($key);
            $plugin->url = $config['url'] ?? null;
            $plugin->license = $config['license'] ?? null;
            $plugin->namespace = $config['namespace'] ?? null;
            $plugin->screenshot = $config['screenshot'] ?? null;
            $plugin->logo = $config['logo'] ?? null;
            $plugin->documentation_url = $config['documentation_url'] ?? null;

            $plugins[] = $plugin;
        }

        return $plugins;
    }

    public function activatePlugin($pluginKey)
    {
        $this->pluginConfigHelper->activatePlugin($pluginKey);
    }

    public function deactivatePlugin($pluginKey)
    {
        $this->pluginConfigHelper->deactivatePlugin($pluginKey);
    }
}
