<?php

namespace Raakkan\Yali\Core\Settings;

use Raakkan\Yali\Core\Settings\Concerns\HasSettingGroup;
use Raakkan\Yali\Core\Settings\Models\YaliSettingsModel;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingSource;
use Raakkan\Yali\Core\Support\Facades\YaliLog;

class SettingLoader
{
    use HasSettingGroup, HasSettingSource;
    protected $model = YaliSettingsModel::class;

    public function getModelQuery()
    {
        return $this->getModel()->newQuery();
    }

    public function getModel()
    {
        $model = $this->model;

        return new $model();
    }


    public function get($name)
    {
        $setting = $this->getModelQuery()->where('source', '=', $this->getSource())->where('group', '=', $this->getGroup())->where('name', '=', $name)->first();

        if ($setting) {
            return json_decode($setting->value);
        }else{
            YaliLog::error('Setting not found: '.$name, ['source' => $this->getSource(), 'group' => $this->getGroup()]);
            return null;
        }
    }
}
