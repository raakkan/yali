<?php

namespace Raakkan\Yali\Core\Support\Icon\Loader;

class IconLoader extends BaseIconLoader
{
    protected $iconPath;

    public function __construct()
    {
        $this->iconPath = __DIR__ . '/../../../../../resources/icons';
    }

    public function getIconPath()
    {
        return $this->iconPath;
    }
}
