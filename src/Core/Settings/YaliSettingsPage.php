<?php

namespace Raakkan\Yali\Core\Settings;

use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Pages\BasePage;
use Raakkan\Yali\Core\Settings\SettingField;
use Raakkan\Yali\Core\Support\Icon\IconManager;
use Raakkan\Yali\Core\Support\Facades\YaliSetting;

class YaliSettingsPage extends BasePage
{
    protected static $slug = '/settings/yali-settings';
    protected static $title = 'Yali Settings';

    protected static $navigationOrder = 999;
    protected static $navigationIcon = 'language';
    protected static $navigationLabel = 'Yali Settings';
    protected static $navigationGroup = 'Settings';
    protected static $navigationGroupIcon = 'settings';

    protected static $view = 'yali::pages.yali-settings-page';

    public function mount()
    {
        
    }

    public static function getSettingFields()
    {
        $languages = Language::getActiveLanguages();
        $languages = $languages->pluck('name', 'code')->toArray();

        $iconPacks = app(IconManager::class)->getIconPacks();
        $iconSelectData = [];

        foreach ($iconPacks as $iconPack) {
            $iconSelectData[$iconPack['name']] = $iconPack['name'];
        }
        
        return [
            SettingField::make('default_language')->group('general')->select()->customizeInputField(function ($inputField) {
                $inputField->placeholder('Select Default Language');
            })->options($languages)->default('en'),
            SettingField::make('icon_pack')->select()->group('icons')->customizeInputField(function ($inputField) {
                $inputField->placeholder('Select Icon Pack');
            })->options($iconSelectData),
        ];
    }

    public function getSettingsByGroup($group)
    {
        return YaliSetting::getSettingsByGroup($group);
    }

    public function submit()
    {
        dd('submit');
    }
}
