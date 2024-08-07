<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

use Raakkan\Yali\Core\Settings\Models\YaliSettingsModel;

trait HasSettingModel
{
    protected $model = YaliSettingsModel::class;

    protected $beforeSaveCallback;
    protected $afterSaveCallback;

    public function getModelQuery()
    {
        return $this->getModel()->newQuery();
    }

    public function getModel()
    {
        $model = $this->model;

        return new $model();
    }

    public function checkSettingExistsInDb()
    {
        $query = $this->getModelQuery();

        return $query->where('source', $this->getSource())->where('group', $this->getGroup())->where('name', $this->getName())->exists();
    }

    public function createSettingInDb()
    {
        $model = $this->getModel();
        $model->group = $this->getGroup();
        $model->source = $this->getSource();
        $model->name = $this->getName();
        $model->type = $this->getType();
        $model->value = json_encode($this->getDefault());
        $model->lock = $this->isLocked();
        $model->encrypt = $this->isEncryptionEnabled();
        $model->cache = $this->isCacheEnabled();
        $model->note = $this->getNote();
        $model->save();
    }

    public function attachDbValueToField()
    {
        $model = $this->getModelQuery()->where('source', $this->getSource())->where('group', $this->getGroup())->where('name', $this->getName())->first();

        if ($model) {
            $this->setValue(json_decode($model->value));
            $this->setOldValue(json_decode($model->value));

            $this->inputField->setValue(json_decode($model->value));
            $this->inputField->setOldValue(json_decode($model->value));
        }
    }

    public function save()
    {
        if ($this->beforeSaveCallback) {
            call_user_func($this->beforeSaveCallback, $this);
        }

        $model = $this->getModelQuery()->where('source', $this->getSource())->where('group', $this->getGroup())->where('name', $this->getName())->first();
        $model->value = json_encode($this->getValue());
        $model->save();

        if ($this->afterSaveCallback) {
            call_user_func($this->afterSaveCallback, $this);
        }
    }

    public function beforeSave(callable $callback)
    {
        $this->beforeSaveCallback = $callback;
        return $this;
    }

    public function afterSave(callable $callback)
    {
        $this->afterSaveCallback = $callback;
        return $this;
    }
}
