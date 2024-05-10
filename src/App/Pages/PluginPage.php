<?php 

namespace Raakkan\Yali\App\Pages;

use Raakkan\Yali\Core\Pages\BasePage;

class PluginPage extends BasePage
{
    protected $title = 'Plugin Page';

    public function render()
    {
        return view('yali::pages.plugin-page');
    }
}
