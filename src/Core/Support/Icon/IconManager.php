<?php 

namespace Raakkan\Yali\Core\Support\Icon;

use Raakkan\Yali\Core\Support\Icon\Loader\IconLoader;

class IconManager
{
    protected $icons = [];

    protected $iconLoader;

    public function __construct()
    {
        $this->iconLoader = new IconLoader();
    }

    public function loadIcons()
    {
        dd($this->iconLoader->getIcons());
    }
}
