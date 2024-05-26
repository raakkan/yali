<?php 

namespace Raakkan\Yali\App\Pages;

use Raakkan\Yali\App\ManageLanguagePage;
use Raakkan\Yali\App\ManageTranslationPage;
use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Utils\RouteUtils;

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

    public static function getChildNavigationItems(): array
    {
        return [
            [
                'label' => 'Manage Language',
                'slug' => '{language}/manage',
                'route' => RouteUtils::getRouteNameByClass(static::class).'.manage-language',
                'class' => ManageLanguagePage::class,
                'type' => static::getType(),
                'icon' => 'child-icon-1',
                'order' => 1,
                'path' => '{language}/manage',
                'isHidden' => true,
            ],
            [
                'label' => 'Manage Translation',
                'slug' => '{language}/translations',
                'route' => RouteUtils::getRouteNameByClass(static::class).'.manage-translation',
                'class' => ManageTranslationPage::class,
                'type' => static::getType(),
                'icon' => 'child-icon-2',
                'order' => 2,
                'path' => '{language}/translations',
                'isHidden' => true,
            ],
        ];
    }
}