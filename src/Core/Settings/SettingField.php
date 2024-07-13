<?php

namespace Raakkan\Yali\Core\Settings;

use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Forms\Concerns\HasFieldValue;
use Raakkan\Yali\Core\Support\Concerns\{HasName};
use Raakkan\Yali\Core\Support\Concerns\Components\HasLabel;
use Raakkan\Yali\Core\Settings\Concerns\{
    HasSettingTypes,
    HasSettingStoreTypes,
    HasSettingGroup,
    Cacheable,
    Lockable,
    Encryptable,
    Hideable,
    HasSettingSource,
    HandleAlreadyExistsField,
    HasSettingFieldId
};

class SettingField
{
    use Makable, HasName, HasLabel, HasSettingTypes, HasSettingStoreTypes, HasSettingGroup, Cacheable, Lockable, Encryptable, Hideable,
        HasFieldValue, HasSettingSource, HandleAlreadyExistsField, HasSettingFieldId;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function render()
    {
        if ($this->isHidden()) {
            return '';
        }

        if ($this->isAlreadyExists()) {
            return $this->getAlreadyExistedField()->render();
        }

        return $this->getName();
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'label' => $this->getLabel(),
            'type' => $this->getType(),
            'group' => $this->getGroup(),
            'source' => $this->getSource(),
            'value' => $this->getValue(),
            'alreadyExists' => $this->isAlreadyExists(),
            'alreadyExistedField' => $this->isAlreadyExists() ? $this->getAlreadyExistedField()->toArray() : null,
        ];
    }
}