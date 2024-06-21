<?php 

namespace Raakkan\Yali\App;

use Livewire\WithPagination;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\View\InfoMessage;
use Raakkan\Yali\App\ManageTranslationPage;
use Raakkan\Yali\Core\Forms\Fields\TextField;
use Raakkan\Yali\Core\Resources\BaseResource;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;
use Raakkan\Yali\Core\Resources\Actions\RestoreAction;
use Raakkan\Yali\Core\Support\Enums\Css\LayoutMaxWidth;
use Raakkan\Yali\Core\Resources\Actions\ForceDeleteAction;
use Raakkan\Yali\Core\Translation\Actions\ManageTranslationAction;

class LanguagesPage extends BaseResource
{
    use WithPagination;
    use HasPagination;
    use HasRecords;

    protected static $slug = 'languages';
    protected static $title = 'Languages';

    protected static $navigationOrder = 99;
    protected static $navigationIcon = 'language';
    protected static $navigationLabel = 'Languages';

    protected static $view = 'yali::pages.languages-page';

    protected static $model = \Raakkan\Yali\Models\Language::class;

    public function mount()
    {
    }

    public function getViewData()
    {
        return [
            'languages' => $this->getRecords($this->getModelQuery())
        ];
    }

    public static function getHeaderActions()
    {
        $actions[CreateAction::class] = CreateAction::make();
        
        return $actions;
    }

    public static function getActions($model)
    {
        $actions = [];
        $actions[EditAction::class] = EditAction::make()->setModel($model);
        $actions[DeleteAction::class] = static::getDeleteAction($model);

        $actions[ManageTranslationAction::class] = ManageTranslationAction::make()->setModel($model)->link(ManageTranslationPage::getRouteName());

        if(static::isSoftDeletesEnabled()) {
            $actions[RestoreAction::class] = RestoreAction::make()->setModel($model);
            $actions[ForceDeleteAction::class] = static::getForceDeleteAction($model);
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

    public static function getDeleteAction($model)
    {
        return DeleteAction::make()
            ->setModel($model)
            ->confirmation(true, true)
            ->beforeConfirmationOpen(function ($form) {
                return $form->getModel()->code === 'en' ? false : true;
            }, 'English language cannot be deleted.')
            ->beforeConfirmationOpen(function ($form) {
                return $form->getModel()->is_default ? false : true;
            }, 'Default language cannot be deleted.')
            ->confirmationTitle('Delete Language')
            ->confirmationMessage(fn ($form) => 'Are you sure you want to delete ' . $form->getModel()->name . ' language?')
            ->confirmationButtonLoadingLabel('Language deleting...');
    }

    public static function getForceDeleteAction($model)
    {
        return ForceDeleteAction::make()
        ->setModel($model)
        ->confirmationTitle('Force Delete Language')
            ->confirmationMessage(fn ($form) => 'Are you sure you want to permanently delete ' . $form->getModel()->name . ' language?')
            ->confirmationButtonLoadingLabel('Force Language deleting...')
        ->form(function ($form) {
            return $form->fields([
                TextField::make('name')->required()->placeholder('Type language name to confirm')->disableLabel(),
            ])->customizeSubmitButton(function ($button) {
                $button->setLabel('Delete')->addClass('btn-danger');
            })->title('Delete Language')->addHeaderMessage(function ($form) {
                return InfoMessage::make('If you delete this language, it will be permanently deleted')->icon('exclamation')->info();
            })->addHeaderMessage(function ($form) {
                return InfoMessage::make('Type <b>&nbsp;"' . $form->getModel()->name . '"&nbsp;</b> to confirm')->danger();
            });
        })->action(function ($model, $formData) {

            throw_if($formData['name'] !== $model->name, new \Exception('Language name does not match'));

            if ($model->name === $formData['name']) {
                $model->forceDelete();
            }
        });
    }

    public function excuteAction($actionClass, $model)
    {
        $modelWithRecord = $this->getRecord(static::getModelQuery(), static::getModelPrimaryKey(), $model);
        $action = static::getAction($actionClass, $modelWithRecord);

        if ($action) {
            try {
                $action->execute();

                $this->dispatch('refresh-page');
                $this->dispatch('toast', type: 'success', message: 'Successful');
            } catch (\Exception $e) {
                $this->dispatch('toast', type: 'error', message: $e->getMessage());
            }
        }
    }

    public static function getPages()
    {
        return [
            'create' => ManageTranslationPage::class
        ];
    }
}