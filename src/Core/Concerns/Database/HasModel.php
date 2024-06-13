<?php

namespace Raakkan\Yali\Core\Concerns\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

trait HasModel
{
    protected static $model;
    protected static $modelInstance;
    protected static $modelPrimaryKey;

    public static function getModel()
    {
        if (!class_exists(static::$model)) {
            throw new \InvalidArgumentException("Model class '" . static::$model . "' does not exist.");
        }

        if (!isset(static::$modelInstance)) {
            $modelClass = static::$model;
            static::$modelInstance = new $modelClass();
        }

        if (!isset(static::$modelPrimaryKey)) {
            static::$modelPrimaryKey = static::$modelInstance->getKeyName();
        }

        return static::$modelInstance;
    }

    public function setModel($model)
    {
        if (is_string($model) && class_exists($model)) {
            $modelInstance = new $model();
        } elseif ($model instanceof Model) {
            $modelInstance = $model;
        } else {
            throw new \InvalidArgumentException("The provided model must be a valid class name or an instance of " . Model::class);
        }
        
        static::$model = get_class($modelInstance);
        static::$modelInstance = $modelInstance;
    
        if (!isset(static::$modelPrimaryKey)) {
            static::$modelPrimaryKey = $modelInstance->getKeyName();
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

}
