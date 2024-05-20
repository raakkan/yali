<?php 

namespace Raakkan\Yali\App;

use Livewire\Component;
use Raakkan\Yali\Core\Pages\YaliPage;

class DashboardPage extends YaliPage
{
    protected static $title = 'Dashboard';

    protected static $navigationOrder = 1;

    protected static $view = 'yali::pages.dashboard-page';

    public $name;

    public function save()
    {
        dd($this->name);
    }
}