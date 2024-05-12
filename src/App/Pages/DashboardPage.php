<?php 

namespace Raakkan\Yali\App\Pages;

use Livewire\Component;
use Raakkan\Yali\Core\Pages\YaliPage;

class DashboardPage extends YaliPage
{
    protected $title = 'Dashboard';
    protected $routeName = '/';

    protected $navigationOrder = 1;

    protected $view = 'yali::pages.dashboard-page';

    public $name;

    public function save()
    {
        
    }
}