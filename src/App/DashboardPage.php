<?php 

namespace Raakkan\Yali\App;

use Livewire\Component;
use Raakkan\Yali\Core\Pages\YaliPage;

class DashboardPage extends YaliPage
{
    protected static $title = 'Dashboard';

    protected static $navigationOrder = 0;

    protected static $navigationIcon = 'dashboard';

    protected static $view = 'yali::pages.dashboard-page';

    protected static $slug = '/';

    public $name;

    public function save()
    {
        dd($this->name);
    }
    
    public static function getRouteName(): string
    {
        return 'yali::pages.dashboard';
    }
}