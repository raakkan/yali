<?php

namespace Raakkan\Yali\Core\Support\Icon;

use Illuminate\Support\Facades\File;
use Raakkan\Yali\Core\Support\Facades\YaliLog;

class IconManager
{
    protected $icons = [];

    protected $iconPacks = [];

    protected $invalidIconPacks = [];

    protected $iconLoader;

    public function __construct()
    {
        $this->loadIcons();
    }

    public function getIconPacks()
    {
        return $this->iconPacks;
    }

    public function loadIconPacks()
    {
        $iconsPacksPath = storage_path('yali/icons/packs');

        if (File::exists($iconsPacksPath)) {
            $directories = File::directories($iconsPacksPath);

            foreach ($directories as $directory) {
                $iconsJsonFile = $directory.'/icons.json';

                if (File::exists($iconsJsonFile) && File::size($iconsJsonFile) > 0) {
                    $json = json_decode(File::get($iconsJsonFile), true);

                    if (is_array($json) && isset($json['name']) && isset($json['icons']) && count($json['icons']) > 0) {
                        $iconPack = $json['name'];
                        $this->iconPacks[] = [
                            'name' => $iconPack,
                            'path' => $directory,
                            'icon_json' => $iconsJsonFile,
                            'icons' => $json['icons'],
                        ];
                    } else {
                        $this->invalidIconPacks[] = $json;
                    }
                }
            }
        }
    }

    public function loadIcons()
    {
        $this->loadIconPacks();
        
        $activeIconPack = yali_setting('icon_pack', 'icons');
        
        $icons = $this->getIconPack($activeIconPack)['icons'];

        $directory = $this->getIconPack($activeIconPack)['path'];

        foreach ($icons as $icon) {
            $iconName = $icon['name'];
            $iconPath = $directory.'/'.$icon['path'];

            $this->icons[$iconName] = [
                'path' => $iconPath,
            ];
        }
    }

    public function getIconPack($iconPackName)
    {
        foreach ($this->iconPacks as $iconPack) {
            if ($iconPack['name'] == $iconPackName) {
                return $iconPack;
            }
        }
        return null;
    }

    public function getIcon($iconName)
    {
        if (! isset($this->icons[$iconName])) {
            return null;
        }

        $iconPath = $this->icons[$iconName]['path'];

        if (! file_exists($iconPath)) {
            return null;
        }

        $iconHtml = file_get_contents($iconPath);

        if (! $iconHtml) {
            YaliLog::error('IconManager: Invalid SVG icon: '. $iconName);
            return null;
        }

        // Check if the SVG is valid
        $svgXml = simplexml_load_string($iconHtml);
        if ($svgXml === false) {
            YaliLog::error('IconManager: Invalid SVG icon: '. $iconName);
            return null;
        }

        return $iconHtml;
    }
}
