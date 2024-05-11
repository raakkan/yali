<?php 

namespace Raakkan\Yali\App\Pages;

use Raakkan\Yali\Core\Pages\BasePage;
use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Plugin\Dtos\Plugin;
use Raakkan\Yali\Core\Plugin\PluginConfigHelper;

class PluginPage extends YaliPage
{
    protected $title = 'Plugins';
    protected $slug = 'plugins';

    protected $navigationOrder = 100;

    protected $view = 'yali::pages.plugin-page';

    public $plugins = [];

    public function mount()
    {
        $this->plugins = app()->make(PluginConfigHelper::class)->getAllPlugins();
    }
}
