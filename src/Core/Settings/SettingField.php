<?php

namespace Raakkan\Yali\Core\Settings;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Forms\Concerns\HasFieldValue;
use Raakkan\Yali\Core\Support\Concerns\{ HasName, HasLabel };
use Raakkan\Yali\Core\Settings\Concerns\{ HasSettingTypes, HasSettingStoreTypes, HasFormActivation };

class SettingField extends YaliComponent
{
    use Makable, HasName, HasLabel, HasSettingTypes, HasSettingStoreTypes, HasFormActivation,
    HasFieldValue;

    protected $view = 'yali::settings.setting-field';
    protected $componentName = 'field';

    protected $cache = true;
    protected $lock = false;
    protected $encrypted = false;
    protected $hide = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function cache($cache = true)
    {
        $this->cache = $cache;

        return $this;
    }

    public function isCached()
    {
        return $this->cache;
    }

    public function lock($lock = true)
    {
        $this->lock = $lock;

        return $this;
    }

    public function encrypt($encrypted = true)
    {
        $this->encrypted = $encrypted;

        return $this;
    }

    public function hide($hide = true)
    {
        $this->hide = $hide;
        return $this;
    }

}