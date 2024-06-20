<?php

namespace Raakkan\Yali\Core\Concerns\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

trait HasModel
{
    protected static $model;
    protected static $modelInstances = [];
    protected static $modelPrimaryKey;

    public static function getModel()
    {
        $class = static::class;

        if (!class_exists(static::$model)) {
            throw new \InvalidArgumentException("Model class '" . static::$model . "' does not exist.");
        }

        if (!isset(static::$modelInstances[$class])) {
            $modelClass = static::$model;
            static::$modelInstances[$class] = new $modelClass();
        }

        if (!isset(static::$modelPrimaryKey)) {
            static::$modelPrimaryKey = static::$modelInstances[$class]->getKeyName();
        }

        return static::$modelInstances[$class];
    }

    public function setModel($model)
    {
        $class = static::class;

        if (is_string($model) && class_exists($model)) {
            static::$model = $model;
            static::$modelInstances[$class] = new $model();
        } elseif ($model instanceof Model) {
            static::$model = get_class($model);
            static::$modelInstances[$class] = $model;
        } else {
            throw new \InvalidArgumentException("The provided model must be a valid class name or an instance of " . Model::class);
        }

        if (!isset(static::$modelPrimaryKey)) {
            static::$modelPrimaryKey = static::$modelInstances[$class]->getKeyName();
        }

        return $this;
    }

    public static function getModelPrimaryKey(): string
    {
        return static::$modelPrimaryKey;
    }

    public static function getModelName(): string
    {
        return class_basename(static::getModel());
    }

    public static function getModelQuery()
    {
        return static::getModel()->newQuery();
    }

    public function getModelIdentifier()
    {
        return $this->getModel()->{$this->getModelPrimaryKey()};
    }

    public static function isSoftDeletesEnabled(): bool
    {
        return in_array(SoftDeletes::class, class_uses(static::getModel()));
    }

    public static function hasModel(): bool
    {
        return class_exists(static::$model);
    }

}
