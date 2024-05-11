<?php 

namespace Raakkan\Yali\App\Pages;

use Raakkan\Yali\Core\Pages\BasePage;
use Raakkan\Yali\Core\Pages\YaliPage;

class PluginPage extends YaliPage
{
    protected $title = 'Plugin Page';
    protected $slug = 'plugins';

    protected $navigationOrder = 100;

    protected $view = 'yali::pages.plugin-page';
}
