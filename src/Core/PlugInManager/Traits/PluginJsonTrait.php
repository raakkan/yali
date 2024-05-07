<?php 

namespace Raakkan\Yali\Core\PlugInManager\Traits;

trait PluginJsonTrait
{
    protected $pluginJson;

    /**
     * Get the value of pluginJson
     */ 
    public function getPluginJson()
    {
        return $this->pluginJson;
    }

    /**
     * Set the value of pluginJson
     *
     * @return  self
     */ 
    public function setPluginJson($pluginJson)
    {
        $this->pluginJson = $pluginJson;

        return $this;
    }
}