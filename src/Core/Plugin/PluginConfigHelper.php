<?php

namespace Raakkan\Yali\Core\Plugin;

use Raakkan\Yali\Core\Plugin\Dtos\PluginDto;

class PluginConfigHelper
{
    protected $configPath;

    public function __construct()
    {
        $this->configPath = __DIR__ . '/../../../plugins.php';
        
        if (!file_exists($this->configPath)) {
            $this->generatePluginsFile();
        }
    }

    protected function generatePluginsFile()
    {
        $content = "<?php\n\nreturn [\n    'plugins' => [],\n];";
        file_put_contents($this->configPath, $content);
    }

    public function getAllPlugins()
    {
        $config = require $this->configPath;
        
        return array_map(function ($pluginConfig) {
            return new PluginDto(
                $pluginConfig['id'] ?? null,
                $pluginConfig['name'] ?? null,
                $pluginConfig['version'] ?? null,
                $pluginConfig['description'] ?? null,
                $pluginConfig['author'] ?? null,
                $pluginConfig['active'] ?? null,
                $pluginConfig['path'] ?? null,
                $pluginConfig['url'] ?? null,
                $pluginConfig['license'] ?? null,
                $pluginConfig['namespace'] ?? null,
                $pluginConfig['screenshot'] ?? null,
                $pluginConfig['logo'] ?? null,
                $pluginConfig['documentation_url'] ?? null,
                $pluginConfig['invalidFields'] ?? []
            );
        }, $config['plugins']);
    }

    public function addConfig(PluginDto $plugin)
    {
        $invalidFields = [];

        if (empty($plugin->getName())) {
            $invalidFields[] = 'name';
        }
        if (empty($plugin->getVersion())) {
            $invalidFields[] = 'version';
        }
        if (empty($plugin->getAuthor())) {
            $invalidFields[] = 'author';
        }
        if (empty($plugin->namespace)) {
            $invalidFields[] = 'namespace';
        }

        if (!empty($invalidFields)) {
            $plugin->invalidFields = $invalidFields;
        }

        $config = require $this->configPath;
        
        // Check if the plugin configuration already exists
        $existingPlugin = array_filter($config['plugins'], function ($pluginConfig) use ($plugin) {
            return $pluginConfig['id'] === $plugin->getId();
        });
        
        if (!empty($existingPlugin)) {
            // Plugin configuration already exists, you can handle this case as needed
            // For example, you can update the existing configuration or skip adding it again
            return;
        }
        
        $config['plugins'][] = [
            'id' => $plugin->getId(),
            'name' => $plugin->getName(),
            'description' => $plugin->getDescription(),
            'version' => $plugin->getVersion(),
            'author' => $plugin->getAuthor(),
            'active' => $plugin->isActive(),
            'path' => $plugin->path,
            'url' => $plugin->url,
            'license' => $plugin->license,
            'namespace' => $plugin->namespace,
            'screenshot' => $plugin->screenshot,
            'logo' => $plugin->logo,
            'documentation_url' => $plugin->documentation_url,
            'invalidFields' => $plugin->invalidFields
        ];
        
        $this->saveConfig($config);
    }

    public function activatePlugin($pluginId)
    {
        $config = require $this->configPath;
        
        foreach ($config['plugins'] as &$pluginConfig) {
            if ($pluginConfig['id'] === $pluginId) {
                $pluginConfig['active'] = true;
                break;
            }
        }
        
        $this->saveConfig($config);
    }

    public function deactivatePlugin($pluginId)
    {
        $config = require $this->configPath;
        
        foreach ($config['plugins'] as &$pluginConfig) {
            if ($pluginConfig['id'] === $pluginId) {
                $pluginConfig['active'] = false;
                break;
            }
        }
        
        $this->saveConfig($config);
    }

    public function removePlugin($pluginId)
    {
        $config = require $this->configPath;
        
        $config['plugins'] = array_filter($config['plugins'], function ($pluginConfig) use ($pluginId) {
            return $pluginConfig['id'] !== $pluginId;
        });
        
        $this->saveConfig($config);
    }

    protected function saveConfig(array $config)
    {
        $content = "<?php\n\nreturn " . var_export($config, true) . ";";
        file_put_contents($this->configPath, $content);
    }
}
