<?php

namespace Raakkan\Yali\Core\Concerns\Database;

use Illuminate\Database\Eloquent\Model;

trait HasModel
{
    protected static $model;
    protected static $primaryKey = 'id';

    public static function getModel()
    {
        if (!class_exists(static::$model)) {
            throw new \InvalidArgumentException("Model class '" . static::$model . "' does not exist.");
        }

        return static::$model;
    }

    public static function getModelInstance(): Model
    {
        $modelClass = static::getModel();
        return new $modelClass();
    }

    public static function getPrimaryKey(): string
    {
        return static::$primaryKey;
    }

    public static function getModelName(): string
    {
        return class_basename(static::getModel());
    }

    public static function getModelQuery()
    {
        return static::getModelInstance()->newQuery();
    }
}
