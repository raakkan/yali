<?php

namespace Raakkan\Yali\Core\Settings;

use Raakkan\Yali\Core\Pages\BasePage;
use Raakkan\Yali\Core\Settings\SettingField;
use Raakkan\Yali\Core\Support\Icon\IconManager;

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
        $iconPacks = app(IconManager::class)->getIconPacks();
        $selectData = [];

        foreach ($iconPacks as $iconPack) {
            $selectData[$iconPack['name']] = $iconPack['name'];
        }
        
        return [
            SettingField::make('icon_pack')->select()->customizeInputField(function ($inputField) {
                $inputField->placeholder('Select Icon Pack');
            })->options($selectData),
        ];
    }

    public function submit()
    {
        dd('submit');
    }
}
