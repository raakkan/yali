<?php 

namespace Raakkan\Yali\Core\PlugInManager;

use RegexIterator;
use RecursiveRegexIterator;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Raakkan\Yali\Core\PlugInManager\BasePlugin;

class PlugInManager
{
    protected $plugIns = [];

    public function addPlugIn(BasePlugin $plugIn): void
    {
        $this->plugIns[] = $plugIn;
    }

    public function getPlugins()
    {
        return $this->plugIns;
    }

    public function loadPlugins(): void
    {
        foreach ($this->getPlugins() as $plugIn) {
            app()->register($plugIn);
        }
    }
   
    public function discoverPlugins(string $baseDir): void
    {
        $directoryIterator = new RecursiveDirectoryIterator($baseDir);
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

            $pluigin = new $className(app());
            $pluigin->setPluginJson($json);
            
            $this->addPlugIn($pluigin);
        }
    }
}


