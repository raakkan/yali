<?php

namespace Raakkan\Yali\Core\Resources;

use Illuminate\Support\Str;
use Raakkan\Yali\Core\Pages\BasePage;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Table\Concerns\HasTable;
use Raakkan\Yali\Core\Support\Concerns\Database\HasModel;
use Raakkan\Yali\Core\Support\Concerns\HasSuccessMessages;
use Raakkan\Yali\Core\Resources\Concerns\HasResourceTitles;
use Raakkan\Yali\Core\Resources\Concerns\HasSubmitButtonLabels;

abstract class BaseResource extends BasePage
{
    use HasTable;
    use HasForm;
    use HasModel;
    use HasResourceTitles;
    use HasSubmitButtonLabels;
    use HasSuccessMessages;
    
    public static function getSlug(): string
    {
        return static::$slug ?: Str::plural(Str::kebab(static::getModelName()));
    }

    public static function getType(): string
    {
        return 'resource';
    }

    public static function actions()
    {
        return [
        ];
    }

    public static function getHeaderActions()
    {
        $acitons = [];

        foreach (static::actions() as $action) {
            if (is_subclass_of($action, YaliAction::class)) {
                if ($action->isHeaderAction()) {
                    $acitons[$action->getClassName()] = $action->setModel(static::getModel());
                }
            }
        }

        return $acitons;
    }

    public static function getActions($model)
    {
        $actions = [];

        foreach (static::actions() as $action) {
            if (is_subclass_of($action, YaliAction::class)) {
                if (!$action->isHeaderAction()) {
                    $actions[$action->getClassName()] = $action->setModel($model);
                }
            }
        }
        
        return $actions;
    }

    public static function getAction($actionClass, $model)
    {
        $action = static::getActions($model)[$actionClass] ?? null;
        if (!$action) {
          $action = static::getHeaderActions()[$actionClass] ?? null;
        }
        return $action;
    }

    public function excuteAction($actionClass, $modelKey)
    {
        $modelInstance = null;

        if (method_exists($this, 'getRecord') && method_exists($this, 'getModelQuery')) {
            $modelInstance = $this->getRecord(static::getModelQuery(), static::getModelPrimaryKey(), $modelKey);
        }

        if (!$modelInstance) {
            $modelInstance = static::getModel();
        }

        $action = static::getAction($actionClass, $modelInstance);

        if ($action) {
            try {
                $action->execute();

                $this->dispatch('refresh-page');
                $this->dispatch('toast', type: 'success', message: $action->getSuccessMassage());
            } catch (\Exception $e) {
                $this->dispatch('toast', type: 'error', message: $e->getMessage());
            }
        }
    }
}
