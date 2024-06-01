<?php 

namespace Raakkan\Yali\App\Pages;

use Livewire\Attributes\On;
use Livewire\WithPagination;
use Raakkan\Yali\Core\Support\Enums\Css\LayoutMaxWidth;
use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Concerns\HasTitles;
use Raakkan\Yali\App\ManageTranslationPage;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Forms\Fields\TextField;
use Raakkan\Yali\Core\Concerns\HasButtonLabels;
use Raakkan\Yali\Core\Concerns\HasPageMessages;
use Raakkan\Yali\Core\Forms\Fields\ToggleField;
use Raakkan\Yali\Core\Concerns\HasDeleteMessages;
use Raakkan\Yali\Core\Concerns\HasSuccessMessages;
use Raakkan\Yali\Core\Contracts\HasTitlesInterface;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;

class LanguagesPage extends YaliPage implements HasTitlesInterface
{
    use HasForm;
    use WithPagination;
    use HasTitles;
    use HasButtonLabels;
    use HasPageMessages;
    use HasDeleteMessages;
    use HasSuccessMessages;

    protected static $slug = 'languages';

    protected static $navigationOrder = 99;
    protected static $navigationIcon = 'language';

    protected static $view = 'yali::pages.languages-page';

    public function mount()
    {
        
    }

    public function getViewData()
    {
        return [
            'languages' => Language::withTrashed()->paginate(3)
        ];
    }

    #[On('refresh-page')] 
    public function dcxz()
    {
        // TODO: page reload stuck in some page/2
        $this->resetPage();
    }

    public function form(YaliForm $form): YaliForm
    {
        return $form->fields([
            TextField::make('name')->required(),
            // TODO: code validation
            TextField::make('code')->required(),
            ToggleField::make('is_default')->default(false),
            ToggleField::make('is_active')->default(true),
            ToggleField::make('rtl')->default(false),
        ])->beforeFormSubmit(function ($data, $model) {
            // dd($data, $model);
        })->gridColumns(2)->maxWidth(LayoutMaxWidth::XL);
    }

    public static function getChildNavigationItems(): array
    {
        return [
            [
                'label' => 'Manage Translation',
                'slug' => '{language}/translations',
                'route' => static::getRouteName(). '.manage-translation',
                'class' => ManageTranslationPage::class,
                'type' => static::getType(),
                'icon' => 'child-icon-2',
                'order' => 2,
                'path' => '{language}/translations',
                'isHidden' => true,
            ],
        ];
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
        
        if (array_key_exists($actionClass, $this->getHeaderActions())) {
            return $this->getHeaderActions()[$actionClass];
        }
        
        if (array_key_exists($actionClass, $this->getActions())) {
            return $this->getActions()[$actionClass];
        }
        
        return null;
    }

    public function getActions()
    {
        $actions = [
            EditAction::make()->setSource($this)->modal(),
            DeleteAction::make()->setSource($this)
        ];

        $data = [];
        foreach ($actions as $action) {
            $data[get_class($action)] = $action;
        }

        return $data;
    }

    public function getHeaderActions()
    {
        $actions = [CreateAction::make()->setSource($this)->modal()->setModel(new Language())->setLabel('Create Language')->classes(['btn', 'btn-ghost', 'btn-sm'])];
        
        $data = [];
        foreach ($actions as $action) {
            $data[get_class($action)] = $action;
        }

        return $data;
    }

    public function delete($id)
    {
        $language = Language::withTrashed()->find($id);

        if ($language->is_default) {
            $this->dispatch('toast', type: 'error', message: 'Default language cannot be deleted.');
            return;
        }

        if ($language->code === 'en') {
            $this->dispatch('toast', type: 'error', message: 'English language cannot be deleted.');
            return;
        }

        if ($language->trashed()) {
            // Hard delete
            $language->forceDelete();
            $this->dispatch('toast', type: 'success', message: 'Language has been permanently deleted.');
        } else {
            // Soft delete
            $language->delete();
            $this->dispatch('toast', type: 'success', message: 'Language has been deleted.');
        }
    }

    public static function getDefaultTitle(): string
    {
        return __('Language');
    }
}