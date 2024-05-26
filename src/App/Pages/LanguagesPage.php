<?php 

namespace Raakkan\Yali\App\Pages;

use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Pages\YaliPage;

class LanguagesPage extends YaliPage
{
    protected static $title = 'Translations';
    protected static $slug = 'translations';

    protected static $navigationOrder = 99;
    protected static $navigationIcon = 'language';

    protected static $view = 'yali::pages.languages-page';

    public $languages = [];

    public function mount()
    {
        $this->languages = Language::all();
    }
}