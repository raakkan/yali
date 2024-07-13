<?php

namespace Raakkan\Yali\Core\Settings;
use Raakkan\Yali\Core\Support\Facades\YaliLog;

class SettingsManager
{
    protected $settings = [];

    public function registerSettings($settings, $source = 'yali')
    {
        foreach ($settings as $setting) {
            if ($setting instanceof SettingField) {
                $setting = $setting->setSource($source);

                $setting->generateId();

                $id = $setting->getId();

                if ($this->idExists($id)) {
                    $setting = $setting->setAlreadyExistedField($this->settings[$id]);
                    $id = $this->generateUniqueId($id);

                    YaliLog::warning('Setting field ' . $setting->getName() . ' already exists. A new id will be generated: ' . $id, ['setting' => $setting->toArray()]);
                }
                
                $this->settings[$id] = $setting;
            }
        }
        
        return $this;
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function getSetting($id)
    {
        return $this->settings[$id];
    }

    protected function idExists($id)
    {
        return isset($this->settings[$id]);
    }

    protected function generateUniqueId($id)
    {
        $counter = 1;
        $uniqueId = $id;

        while ($this->idExists($uniqueId)) {
            $uniqueId = $id . '_' . $counter;
            $counter++;
        }

        return $uniqueId;
    }
}
