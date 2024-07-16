<?php

namespace Raakkan\Yali\Core\Settings;

use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Pages\BasePage;
use Illuminate\Support\Facades\Artisan;
use Raakkan\Yali\Core\Support\Icon\IconManager;
use Raakkan\Yali\Core\Translation\LocaleConfig;
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

    public $settings = [];

    public function mount()
    {
        $settings = array_merge(YaliSetting::getSettingsByGroup('general'), YaliSetting::getSettingsByGroup('icons'));

        foreach ($settings as $setting) {
            $this->settings[$setting->getSource()][$setting->getGroup()][$setting->getName()] = $setting->getValue();
        }
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
            })->options($languages)->default('en')->afterSave(function ($field) {
                Language::setDefaultLanguage($field->getValue());
            }),

            SettingField::make('icon_pack')->select()->group('icons')->customizeInputField(function ($inputField) {
                $inputField->placeholder('Select Icon Pack');
            })->options($iconSelectData),
        ];
    }

    public function getSettingsByGroup($group)
    {
        return YaliSetting::getSettingsByGroup($group);
    }

    public function submit($group)
    {
        $fields = YaliSetting::getSettingsByGroup($group);

        foreach ($fields as $field) {
            $field->setValue($this->settings[$field->getSource()][$field->getGroup()][$field->getName()]);
            $field->save();
        }

        $this->dispatch('toast', type: 'success', message: 'Settings saved successfully.');
    }
}
