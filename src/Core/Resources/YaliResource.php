<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Str;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Table\YaliTable;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Utils\RouteUtils;
use Raakkan\Yali\App\HandleResourcePage;
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

    protected static $model;

    protected static $createAndEditByModal = false;

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

            if (static::$createAndEditByModal) {
                $this->table->headerActions = [CreateAction::make()->setForm($this->form($this->getForm()))->modalable()];

                $this->table->actions = [
                    EditAction::make()->setForm($this->form($this->getForm()))->modalable(),
                    DeleteAction::make(),
                ];
            }else {
                $this->table->headerActions = [CreateAction::make()->setLink()];

                $this->table->actions = [
                    EditAction::make()->setLink(),
                    DeleteAction::make(),
                ];
            }
        }
        return $this->table;
    }

    public function getQueryBuilder()
    {
        return new ResourceQueryBuilder($this->getModelInstance()->newQuery(), $this->table($this->getTable()));
    }

    public static function getChildNavigationItems(): array
    {
        if (!static::$createAndEditByModal) {
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
        }else {
            return [];
        }
    }
}
