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
    HasSettingFieldId,
    HasSettingModel,
    HasSettingNote
};

class SettingField
{
    use Makable, HasName, HasLabel, HasSettingTypes, HasSettingStoreTypes, HasSettingGroup, Cacheable, Lockable, Encryptable, Hideable,
        HasFieldValue, HasSettingSource, HandleAlreadyExistsField, HasSettingFieldId, HasSettingModel, HasSettingNote;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function render()
    {
        if ($this->isStoreTypeDatabase() && !$this->checkSettingExistsInDb()) {
            $this->createSettingInDb();
        }
        
        if ($this->isAlreadyExists()) {
            return $this->getAlreadyExistedField()->render();
        }

        if ($this->isStoreTypeDatabase()) {
            $this->attachDbValueToField();
        }

        // dd($this->getValue());

        if($this->inputField){
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
        if (!is_array($options) && !is_callable($options)) {
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