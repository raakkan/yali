<?php

namespace Raakkan\Yali\Core\Settings;

use Raakkan\Yali\Core\Pages\BasePage;

class GeneralSettingsPage extends BasePage
{
    protected static $slug = '/settings/general-settings';
    protected static $title = 'General Settings';

    protected static $navigationOrder = 999;
    protected static $navigationIcon = 'language';
    protected static $navigationLabel = 'General Settings';
    protected static $navigationGroup = 'Settings';
    protected static $navigationGroupIcon = 'settings';

    protected static $view = 'yali::pages.settings.general-page';

    public function getSettingFields()
    {
        return [
            SettingField::make('site_name')->text(),
            SettingField::make('site_description')->textarea(),
        ];
    }
}
