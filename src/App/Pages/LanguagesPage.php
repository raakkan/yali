<?php 

namespace Raakkan\Yali\App\Pages;

use Livewire\Attributes\On;
use Livewire\WithPagination;
use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\App\ManageLanguagePage;
use Raakkan\Yali\Core\Concerns\HasTitles;
use Raakkan\Yali\App\ManageTranslationPage;
use Raakkan\Yali\Core\Concerns\HasMessages;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Forms\Fields\TextField;
use Raakkan\Yali\Core\Concerns\HasButtonLabels;
use Raakkan\Yali\Core\Forms\Fields\ToggleField;
use Raakkan\Yali\Core\Contracts\HasTitlesInterface;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;

class LanguagesPage extends YaliPage implements HasTitlesInterface
{
    use HasForm;
    use WithPagination;
    use HasTitles;
    use HasMessages;
    use HasButtonLabels;

    protected static $slug = 'translations';

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
        });
    }

    public static function getChildNavigationItems(): array
    {
        return [
            [
                'label' => 'Manage Language',
                'slug' => '{language}/manage',
                'route' => static::getRouteName(). '.manage-language',
                'class' => ManageLanguagePage::class,
                'type' => static::getType(),
                'icon' => 'child-icon-1',
                'order' => 1,
                'path' => '{language}/manage',
                'isHidden' => true,
            ],
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

    public function getAction()
    {
        return CreateAction::make()->setSource($this)->modal()->setModel(new Language())->setLabel('Create Language');
    }

    public function deleteLanguage($id)
    {
        $language = Language::find($id);

        if ($language->is_default) {
            $this->dispatch('toast', type: 'error', message: 'Default language cannot be deleted.');
            return;
        }

        if ($language->code === 'en') {
            $this->dispatch('toast', type: 'error', message: 'English language cannot be deleted.');
            return;
        }

        $language->delete();

        $this->dispatch('toast', type: 'success', message: 'Language has been deleted.');
    }

    public static function getDefaultTitle(): string
    {
        return 'Language';
    }
}