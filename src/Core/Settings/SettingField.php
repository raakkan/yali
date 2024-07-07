<?php

namespace Raakkan\Yali\Core\Settings;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\Support\Concerns\HasName;
use Raakkan\Yali\Core\Support\Concerns\HasLabel;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingTypes;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingStoreTypes;

class SettingField
{
    use Makable, HasName, HasLabel, HasSettingTypes, HasSettingStoreTypes;

    protected $value;

    public function __construct($name)
    {
        $this->name = $name;
    }
}