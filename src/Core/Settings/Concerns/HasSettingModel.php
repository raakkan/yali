<?php

namespace Raakkan\Yali\Core\Settings\Concerns;

use Raakkan\Yali\Core\Settings\Models\YaliSettingsModel;

trait HasSettingModel
{
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

    public function checkSettingExistsInDb()
    {
        $query = $this->getModelQuery();

        if ($this->hasGroup()) {
            $query->where('group', $this->getGroup());
        }

        return $query->where('source', $this->getSource())->where('name', $this->getName())->exists();
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
}