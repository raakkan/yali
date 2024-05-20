<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Resources\ResourceQueryBuilder;
use Raakkan\Yali\Core\Resources\Table\YaliTable;
use Raakkan\Yali\Core\Support\Navigation\HasNavigation;

abstract class YaliResource
{
    use HasNavigation;

    protected static $title = '';

    protected static $model;

    protected $form;

    protected $table;

    public function __construct()
    {
        $this->form = new YaliForm();
        $this->table = new YaliTable($this);
    }

    abstract public function table(): YaliTable;
    abstract public function form(): YaliForm;

    public static function getModel()
    {
        if (!class_exists(static::$model)) {
            throw new \InvalidArgumentException("Model class '" . static::$model . "' does not exist.");
        }

        return static::$model;
    }

    public function getModelInstance(): Model
    {
        $modelClass = $this->getModel();
        return new $modelClass();
    }

    public static function getTitle(): string
    {
        return static::$title;
    }

    public static function getSlug(): string
    {
        return static::$slug ?: Str::plural(Str::kebab(class_basename(static::getModel())));
    }

    public static function getName(): string
    {
        return class_basename(static::class);
    }

    public function getModelName(): string
    {
        return class_basename($this->getModel());
    }

    public static function getType(): string
    {
        return 'resource';
    }

    public function getQueryBuilder()
    {
        return new ResourceQueryBuilder($this->getModelInstance()->newQuery(), $this->table());
    }
}
