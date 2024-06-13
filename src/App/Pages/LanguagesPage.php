<?php 

namespace Raakkan\Yali\App\Pages;

use Livewire\Attributes\On;
use Livewire\WithPagination;
use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\App\ManageTranslationPage;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Forms\Fields\TextField;
use Raakkan\Yali\Core\Concerns\HasPageMessages;
use Raakkan\Yali\Core\Forms\Fields\ToggleField;
use Raakkan\Yali\Core\Concerns\Database\HasModel;
use Raakkan\Yali\Core\Concerns\HasDeleteMessages;
use Raakkan\Yali\Core\Concerns\HasSuccessMessages;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;
use Raakkan\Yali\Core\Support\Enums\Css\LayoutMaxWidth;

class LanguagesPage extends YaliPage
{
    use HasForm;
    use WithPagination;
    use HasPageMessages;
    use HasDeleteMessages;
    use HasSuccessMessages;
    use HasPagination;
    use HasRecords;
    use HasModel;

    protected static $slug = 'languages';

    protected static $navigationOrder = 99;
    protected static $navigationIcon = 'language';
    protected static $navigationLabel = 'Languages';

    protected static $view = 'yali::pages.languages-page';

    public function mount()
    {
        $this->setModel(Language::class);
    }

    public function getViewData()
    {
        return [
            'languages' => $this->getRecords($this->getModelQuery())
        ];
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

        $this->resetPage();
    }
}