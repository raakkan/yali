<?php 

namespace Raakkan\Yali\App;

use Livewire\WithPagination;
use Raakkan\Yali\Core\Resources\BaseResource;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;

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
        $actions[CreateAction::class] = CreateAction::make()->setSource(LanguagesPage::class);
        
        return $actions;
    }

    public static function getActions()
    {
        $actions = [];
        $actions[EditAction::class] = EditAction::make()->setSource(LanguagesPage::class);
        $actions[DeleteAction::class] = DeleteAction::make()->setSource(LanguagesPage::class);
        return $actions;
    }

    public static function getAction($actionClass)
    {
        $action = static::getActions()[$actionClass] ?? null;
        if (!$action) {
          $action = static::getHeaderActions()[$actionClass] ?? null;
        }
        return $action;
    }
}

// public function delete($id)
//     {
//         $language = Language::withTrashed()->find($id);

//         if ($language->is_default) {
//             $this->dispatch('toast', type: 'error', message: 'Default language cannot be deleted.');
//             return;
//         }

//         if ($language->code === 'en') {
//             $this->dispatch('toast', type: 'error', message: 'English language cannot be deleted.');
//             return;
//         }

//         if ($language->trashed()) {
//             // Hard delete
//             $language->forceDelete();
//             $this->dispatch('toast', type: 'success', message: 'Language has been permanently deleted.');
//         } else {
//             // Soft delete
//             $language->delete();
//             $this->dispatch('toast', type: 'success', message: 'Language has been deleted.');
//         }

//         $this->resetPage();
//     }