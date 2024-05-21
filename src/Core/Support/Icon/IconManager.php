<?php

namespace Raakkan\Yali\Core\Support\Icon;

use Illuminate\Support\Facades\Blade;
use Raakkan\Yali\Core\Support\Icon\Loader\IconLoaderInterface;

class IconManager
{
    protected $icons = [];

    protected $iconLoader;

    public function __construct(IconLoaderInterface $iconLoader)
    {
        $this->iconLoader = $iconLoader;
    }

    public function loadIcons()
    {
        $this->icons = $this->iconLoader->getIcons();
    }

    public function getIcon($iconName)
    {
        if (!isset($this->icons[$iconName])) {
            return null;
        }
    
        $iconPath = $this->icons[$iconName]['path'];
        
        if (!file_exists($iconPath)) {
            return null;
        }
    
        $iconHtml = file_get_contents($iconPath);
    
        if (!$iconHtml) {
            return null;
        }
    
        // Check if the SVG is valid
        $svgXml = simplexml_load_string($iconHtml);
        if ($svgXml === false) {
            // SVG is invalid
            return null;
        }
    
        return $iconHtml;
    }
}
