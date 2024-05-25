<?php 

namespace Raakkan\Yali\App\Pages;

use Raakkan\Yali\Core\Pages\YaliPage;

class LanguagesPage extends YaliPage
{
    protected static $title = 'Languages';
    protected static $slug = 'languages';

    protected static $navigationOrder = 100;
    protected static $navigationGroup = 'Translations';

    protected static $view = 'yali::pages.languages-page';

    public function mount()
    {
       
    }
}