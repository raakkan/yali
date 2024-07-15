<?php

namespace Raakkan\Yali\Core\Support\Icon\Loader;

use Illuminate\Support\Facades\File;

class BaseIconLoader implements IconLoaderInterface
{
    public function getIcons()
    {
        $iconPath = $this->getIconPath();
        $icons = [];

        if (File::exists($iconPath)) {
            $files = File::allFiles($iconPath);

            foreach ($files as $file) {
                $relativePath = $file->getRelativePath();
                $iconName = $file->getFilenameWithoutExtension();
                $iconPath = $file->getPathname();

                $prefix = $relativePath ? str_replace('/', '.', $relativePath).'.' : '';
                $iconKey = $prefix.$iconName;

                $icons[$iconKey] = [
                    'path' => $iconPath,
                ];
            }
        }

        return $icons;
    }

    protected function getIconPath()
    {
        // This method should be overridden in the child class to provide the icon path
        return '';
    }
}
