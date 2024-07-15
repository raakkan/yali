<?php

namespace Raakkan\Yali\App;

use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Plugin\PluginConfigHelper;

class PluginPage extends YaliPage
{
    protected static $title = 'Plugins';

    protected static $slug = 'plugins';

    protected static $navigationOrder = 100;

    protected static $view = 'yali::pages.plugin-page';

    public $plugins = [];

    public function mount()
    {
        $this->plugins = app()->make(PluginConfigHelper::class)->getAllPlugins();
    }
}
