<?php 

namespace Raakkan\Yali\App\Pages;

use Raakkan\Yali\Core\Pages\YaliPage;

class TranslationsPage extends YaliPage
{
    protected static $title = 'Translations';
    protected static $slug = 'translations';

    protected static $navigationOrder = 100;

    protected static $navigationGroup = 'Translations';

    protected static $navigationGroupIcon = 'language';

    protected static $view = 'yali::pages.translations-page';

    public function mount()
    {
       
    }
}