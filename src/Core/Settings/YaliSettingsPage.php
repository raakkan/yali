<?php

namespace Raakkan\Yali\Core\Settings;

use Raakkan\Yali\Core\Pages\BasePage;
use Raakkan\Yali\Core\Settings\SettingField;

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

    public static function getSettingFields()
    {
        return [
            SettingField::make('site_name')->text(),
            SettingField::make('site_description')->textarea(),
            SettingField::make('site_name')->text(),
        ];
    }
}
