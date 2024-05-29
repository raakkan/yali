<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Table\YaliTable;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Utils\RouteUtils;
use Raakkan\Yali\App\HandleResourcePage;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Table\Concerns\HasTable;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;
use Raakkan\Yali\Core\Resources\ResourceQueryBuilder;
use Raakkan\Yali\Core\Support\Navigation\HasNavigation;

abstract class YaliResource
{
    use HasNavigation;
    use HasTable;
    use HasForm;

    protected static $title = '';
    protected static $addTitle = '';
    protected static $editTitle = '';

    protected static $model;
    protected static $primaryKey = 'id';

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

    public static function getPrimaryKey(): string
    {
        return static::$primaryKey;
    }

    public static function getTitle(): string
    {
        return static::$title ?: Str::title(static::getModelName());
    }

    public static function getAddTitle(): string
    {
        return static::$addTitle ?: 'Create ' . static::getTitle();
    }

    public static function getEditTitle(): string
    {
        return static::$editTitle ?: 'Update ' . static::getTitle();
    }

    public static function getPluralTitle(): string
    {
        return Str::plural(static::getTitle());
    }

    public static function getSlug(): string
    {
        return static::$slug ?: Str::plural(Str::kebab(static::getModelName()));
    }

    public static function getName(): string
    {
        return class_basename(static::class);
    }

    public static function getModelName(): string
    {
        return class_basename(static::getModel());
    }

    public static function getType(): string
    {
        return 'resource';
    }

    public function getTable()
    {
        if(!$this->table) {
            $this->table = new YaliTable();

            $this->table->headerActions = [CreateAction::make()->modal(slideLeft: true)];

            $this->table->actions = [
                EditAction::make()->modal(slideUp: true),
                DeleteAction::make(),
            ];
        }
        return $this->table;
    }

    public function getQueryBuilder()
    {
        return new ResourceQueryBuilder($this->getModelInstance()->newQuery(), $this->table($this->getTable()));
    }

    public static function getChildNavigationItems(): array
    {
        // TODO: dont register any action is modal
        return [
            [
                'label' => 'Create',
                'slug' => 'create',
                'route' => RouteUtils::getRouteNameByClass(static::class).'.create',
                'class' => HandleResourcePage::class,
                'type' => static::getType(),
                'icon' => 'child-icon-1',
                'order' => 1,
                'path' => 'create',
                'isHidden' => true,
            ],
            [
                'label' => 'Edit',
                'slug' => '{modelKey}/edit',
                'route' => RouteUtils::getRouteNameByClass(static::class).'.edit',
                'class' => HandleResourcePage::class,
                'type' => static::getType(),
                'icon' => 'child-icon-2',
                'order' => 2,
                'path' => '{modelKey}/edit',
                'isHidden' => true,
            ],
        ];
    }

    public static function getClass()
    {
        return static::class;
    }

    public function getAction($action)
    {
        if (is_string($action) && is_subclass_of($action, YaliAction::class)) {
            $actionClass = $action;
        } elseif ($action instanceof YaliAction) {
            $actionClass = get_class($action);
        } else {
            return null;
        }
        
        if (array_key_exists($actionClass, $this->getTable()->getHeaderActions())) {
            return $this->getTable()->getHeaderActions()[$actionClass];
        }
        
        if (array_key_exists($actionClass, $this->getTable()->getActions())) {
            return $this->getTable()->getActions()[$actionClass];
        }
        
        return null;
    }
}
