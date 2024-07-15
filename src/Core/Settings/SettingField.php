<?php

namespace Raakkan\Yali\Core\Settings;

use Raakkan\Yali\Core\Forms\Concerns\HasFieldValue;
use Raakkan\Yali\Core\Settings\Concerns\Cacheable;
use Raakkan\Yali\Core\Settings\Concerns\Encryptable;
use Raakkan\Yali\Core\Settings\Concerns\HandleAlreadyExistsField;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingFieldId;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingGroup;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingModel;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingNote;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingSource;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingStoreTypes;
use Raakkan\Yali\Core\Settings\Concerns\HasSettingTypes;
use Raakkan\Yali\Core\Settings\Concerns\Hideable;
use Raakkan\Yali\Core\Settings\Concerns\Lockable;
use Raakkan\Yali\Core\Support\Concerns\Components\HasLabel;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Support\Concerns\HasName;

class SettingField
{
    use Cacheable, Encryptable, HandleAlreadyExistsField, HasFieldValue, HasLabel, HasName, HasSettingFieldId, HasSettingGroup, HasSettingModel, HasSettingNote,
        HasSettingSource, HasSettingStoreTypes, HasSettingTypes, Hideable, Lockable, Makable;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function render()
    {
        if ($this->isAlreadyExists()) {
            return $this->getAlreadyExistedField()->render();
        }

        // dd($this->getValue());

        if ($this->inputField) {
            if ($this->type === 'select') {
                return $this->getInputField()->options($this->getOptions())->setValue($this->getValue())->render();
            }

            return $this->getInputField()->setValue($this->getValue())->render();
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

    protected $options;

    public function options($options)
    {
        if (! is_array($options) && ! is_callable($options)) {
            throw new \InvalidArgumentException('Options must be an array or a callable');
        }

        $this->options = $options;

        return $this;
    }

    public function getOptions()
    {
        $options = [];

        if (is_callable($this->options)) {
            $options = call_user_func($this->options);
        } else {
            $options = $this->options;
        }

        return $options;
    }
}
