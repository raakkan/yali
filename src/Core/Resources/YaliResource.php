<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Table\YaliTable;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\App\HandleResourcePage;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Concerns\HasTitles;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Concerns\ActionMessages;
use Raakkan\Yali\Core\Table\Concerns\HasTable;
use Raakkan\Yali\Core\Concerns\HasButtonLabels;
use Raakkan\Yali\Core\Concerns\Database\HasModel;
use Raakkan\Yali\Core\Concerns\HasDeleteMessages;
use Raakkan\Yali\Core\Concerns\HasSuccessMessages;
use Raakkan\Yali\Core\Contracts\HasTitlesInterface;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;
use Raakkan\Yali\Core\Resources\ResourceQueryBuilder;
use Raakkan\Yali\Core\Support\Navigation\HasNavigation;

abstract class YaliResource implements HasTitlesInterface
{
    use HasNavigation;
    use HasTable;
    use HasForm;
    use HasModel;
    use HasTitles;
    use HasButtonLabels;
    use ActionMessages;
    use HasDeleteMessages;
    use HasSuccessMessages;

    public static function getSlug(): string
    {
        return static::$slug ?: Str::plural(Str::kebab(static::getModelName()));
    }

    public static function getName(): string
    {
        return class_basename(static::class);
    }

    public static function getType(): string
    {
        return 'resource';
    }

    public function getTable()
    {
        if(!$this->table) {
            $this->table = new YaliTable();

            $this->table->headerActions = [CreateAction::make()->modal()];

            $this->table->actions = [
                EditAction::make()->modal(),
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
                'route' => static::getCreateRouteName(),
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
                'route' => static::getUpdateRouteName(),
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

    public static function getRouteName()
    {
        return Str::kebab(Str::plural(static::getType()) . str_replace('\\', '', static::class));
    }

    public static function getCreateRouteName()
    {
        return static::getRouteName() . '.create';
    }

    public static function getUpdateRouteName()
    {
        return static::getRouteName() . '.edit';
    }

    public static function getDefaultTitle(): string
    {
        return static::getModelName();
    }
}
