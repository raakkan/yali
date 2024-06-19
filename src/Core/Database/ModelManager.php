<?php

namespace Raakkan\Yali\Core\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelManager
{
    protected $model;
    protected $modelInstance;
    protected $modelPrimaryKey;

    public function __construct($model = null)
    {
        if ($model) {
            $this->setModel($model);
        }
    }

    public function getModel()
    {
        if (!$this->modelInstance) {
            throw new \Exception("Model instance not set.");
        }

        return $this->modelInstance;
    }

    public function setModel($model)
    {
        if (is_string($model) && class_exists($model)) {
            $this->model = $model;
            $this->modelInstance = new $model();
        } elseif ($model instanceof Model) {
            $this->model = get_class($model);
            $this->modelInstance = $model;
        } else {
            throw new \InvalidArgumentException("The provided model must be a valid class name or an instance of " . Model::class);
        }

        $this->modelPrimaryKey = $this->modelInstance->getKeyName();
        return $this;
    }

    public function getModelPrimaryKey(): string
    {
        return $this->modelPrimaryKey;
    }

    public function getModelName(): string
    {
        return class_basename($this->getModel());
    }

    public function getModelQuery()
    {
        return $this->getModel()->newQuery();
    }

    public function getModelIdentifier()
    {
        return $this->getModel()->{$this->getModelPrimaryKey()};
    }

    public function isSoftDeletesEnabled(): bool
    {
        return in_array(SoftDeletes::class, class_uses($this->getModel()));
    }
}
