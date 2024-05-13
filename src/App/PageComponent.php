<?php 

namespace Raakkan\Yali\App;

use Livewire\Component;
use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Resources\ResourceManager;

class PageComponent extends YaliPage
{
    protected $title = 'Page Component';
    protected $view = 'yali::pages.page-component';
}