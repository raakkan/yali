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

    abstract public function table(YaliTable $table): YaliTable;
    abstract public function form(YaliForm $form): YaliForm;

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
        return static::$title ?: Str::title(class_basename(static::getModel()));
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
        return new ResourceQueryBuilder($this->getModelInstance()->newQuery(), $this->table($this->getTable()));
    }

    public function getTable()
    {
        if(!$this->table) {
            $this->table = new YaliTable($this);
        }
        return $this->table;
    }

    public function getForm()
    {
        if(!$this->form) {
            $this->form = new YaliForm($this);
        }
        return $this->form;
    }
}
