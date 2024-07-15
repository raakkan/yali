<?php

namespace Raakkan\Yali\Core\Plugin\Traits;

use Raakkan\Yali\Core\Plugin\Dtos\PluginDto;

trait PluginJsonTrait
{
    /**
     * The plugin's JSON configuration.
     *
     * @var PluginDto
     */
    protected $pluginJson;

    /**
     * Get the plugin's JSON configuration.
     *
     * @return PluginDto
     */
    public function getPluginJson()
    {
        return $this->pluginJson;
    }

    /**
     * Set the plugin's JSON configuration.
     *
     * @return $this
     */
    public function setPluginJson(array $pluginJson)
    {
        $this->pluginJson = new PluginDto();
        $this->pluginJson->id = $this->generatePluginId();
        $this->pluginJson->name = $pluginJson['name'] ?? null;
        $this->pluginJson->version = $pluginJson['version'] ?? null;
        $this->pluginJson->description = $pluginJson['description'] ?? null;
        $this->pluginJson->author = $pluginJson['author'] ?? null;
        $this->pluginJson->active = $pluginJson['active'] ?? false;
        $this->pluginJson->path = plugin_path(strtolower($this->getName()));
        $this->pluginJson->url = $pluginJson['url'] ?? null;
        $this->pluginJson->license = $pluginJson['license'] ?? null;
        $this->pluginJson->namespace = $pluginJson['namespace'] ?? null;
        $this->pluginJson->screenshot = $pluginJson['screenshot'] ?? null;
        $this->pluginJson->logo = $pluginJson['logo'] ?? null;
        $this->pluginJson->documentation_url = $pluginJson['documentation_url'] ?? null;

        return $this;
    }
}
