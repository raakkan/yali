<?php

namespace Raakkan\Yali\Core\Plugin\Traits;

trait PluginJsonTrait
{
    /**
     * The plugin's JSON configuration.
     *
     * @var array
     */
    protected $pluginJson;

    /**
     * Get the plugin's JSON configuration.
     *
     * @return array
     */
    public function getPluginJson()
    {
        return $this->pluginJson;
    }

    /**
     * Set the plugin's JSON configuration.
     *
     * @param array $pluginJson
     * @return $this
     */
    public function setPluginJson(array $pluginJson)
    {
        $this->pluginJson = $pluginJson;

        return $this;
    }
}
