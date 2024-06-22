<?php 

namespace Raakkan\Yali\App;

use Livewire\Attributes\On;
use Livewire\WithPagination;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\View\InfoMessage;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\App\ManageTranslationPage;
use Raakkan\Yali\Core\Forms\Fields\TextField;
use Raakkan\Yali\Core\Resources\BaseResource;
use Raakkan\Yali\Core\Forms\Fields\ToggleField;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;
use Raakkan\Yali\Core\Resources\Actions\RestoreAction;
use Raakkan\Yali\Core\Support\Enums\Css\LayoutMaxWidth;
use Raakkan\Yali\Core\Resources\Actions\ForceDeleteAction;
use Raakkan\Yali\Core\Translation\Actions\ManageTranslationAction;
use function Livewire\store;

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

    public function getViewData()
    {
        return [
            'languages' => $this->getRecords($this->getModelQuery())
        ];
    }

    public static function form(YaliForm $form): YaliForm
    {
        return $form->fields([
            TextField::make('name')->required()->disableIf(function ($field) {
                if ($field->getLivewireData() === 'English') {
                    return true;
                }
            }),
            TextField::make('code')->required()->disableIf(function ($field) {
                if ($field->getLivewireData() === 'en') {
                    return true;
                }
            }),
            ToggleField::make('is_active')->default(true),
            ToggleField::make('is_default')->default(false),
        ]);
    }

    public static function actions()
    {
        return [
            CreateAction::make()->modal(slideRight: true)->afterExecute(function ($action, $model, $formData, $result) {
                $englishLanguage = \Raakkan\Yali\Models\Language::where('code', 'en')->first();
            
                if ($model->translations->count() <= 0) { 
                    
                    $englishTranslations = $englishLanguage->translations;
                    
                    foreach ($englishTranslations as $translation) {
                        $newTranslation = $model->translations()->make($translation->toArray());
                        $newTranslation->language_code = $model->code;
                        $newTranslation->save();
                    }
                }

                if ($model->is_default) {
                    $languages = \Raakkan\Yali\Models\Language::all();

                    foreach ($languages as $language) {
                        if ($language->id === $model->id) {
                            continue;
                        }
                        $language->is_default = false;
                        $language->save();
                    }
                }
            
                return $result;
            }),
            EditAction::make()->modal(slideRight: true)->afterExecute(function ($action, $model, $formData, $result) {
                if ($model->is_default) {
                    $model->is_active = true;
                    $model->save();

                    $languages = \Raakkan\Yali\Models\Language::all();

                    foreach ($languages as $language) {
                        if ($language->id === $model->id) {
                            continue;
                        }
                        $language->is_default = false;
                        $language->save();
                    }
                } else {
                    $defaultLanguageExists = \Raakkan\Yali\Models\Language::where('is_default', true)->exists();
                    if (!$defaultLanguageExists) {
                        $englishLanguage = \Raakkan\Yali\Models\Language::where('code', 'en')->first();
                        if ($englishLanguage) {
                            $englishLanguage->is_default = true;
                            $englishLanguage->is_active = true;
                            $englishLanguage->save();
                        }
                    }
                }

                if ($model->is_default && !$model->is_active) {
                    $englishLanguage = \Raakkan\Yali\Models\Language::where('code', 'en')->first();
                    if ($englishLanguage) {
                        $englishLanguage->is_default = true;
                        $englishLanguage->is_active = true;
                        $englishLanguage->save();
                    }

                    $model->is_default = false;
                    $model->save();
                }

                return $result;
            }),
            DeleteAction::make()->afterExecute(function ($action, $model, $formData, $result) {
                $model->is_active = false;
                $model->save();
            
                return $result;
            }),
            RestoreAction::make()->afterExecute(function ($action, $model, $formData, $result) {
                $model->is_active = true;
                $model->save();
            
                return $result;
            }),
            ForceDeleteAction::make(),
            ManageTranslationAction::make()->link(ManageTranslationPage::getRouteName())
        ];
    }

    public static function getActions($model)
    {
        $actions = [];

        foreach (static::actions() as $action) {
            if (is_subclass_of($action, YaliAction::class)) {
                if (!$action->isHeaderAction()) {
                    if ($action instanceof DeleteAction) {
                        $actions[$action->getClassName()] = static::getDeleteAction($action, $model);
                    } elseif ($action instanceof ForceDeleteAction) {
                        $actions[$action->getClassName()] = static::getForceDeleteAction($action, $model);
                    } else {
                        $actions[$action->getClassName()] = $action->setModel($model);
                    }
                }
            }
        }
        
        return $actions;
    }

    public static function getDeleteAction($action, $model)
    {
        return $action
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

    public static function getForceDeleteAction($action, $model)
    {
        return $action
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

    public static function getPages()
    {
        return [
            ManageTranslationPage::class
        ];
    }
}