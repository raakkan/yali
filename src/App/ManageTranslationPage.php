<?php

namespace Raakkan\Yali\App;

use Livewire\Component;
use Livewire\WithPagination;
use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Filters\SelectFilter;
use Raakkan\Yali\Models\TranslationCategory;
use Raakkan\Yali\Core\Forms\Concerns\HasForm;
use Raakkan\Yali\Core\Concerns\HasPageMessages;
use Raakkan\Yali\Core\Concerns\HasDeleteMessages;
use Raakkan\Yali\Core\Concerns\HasSuccessMessages;
use Raakkan\Yali\Core\Concerns\Livewire\HasSearch;
use Raakkan\Yali\Core\Concerns\Livewire\HasFilters;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;

class ManageTranslationPage extends Component
{
    use WithPagination;
    use HasFilters;
    use HasSearch;
    use HasPagination;
    use HasRecords;
    use HasForm;
    use HasPageMessages;
    use HasDeleteMessages;
    use HasSuccessMessages;

    public Language $language;
    protected $view = 'yali::pages.manage-translation-page';

    public function mount()
    {
        
    }

    public function form(YaliForm $form): YaliForm
    {
        return $form;
    }

    public function getQuery()
    {
        return $this->language->translations()->getQuery();
    }

    public function render()
    {
        $query = $this->getQuery();
        
        $this->setSearchColumns(['group', 'key']);
        $this->setPerPage(12);

        return view($this->view, [
            'translations' => $this->getRecords($query),
        ])->layout('yali::layouts.app');
    }

    public function getFilters()
    {
        $translationCategories = TranslationCategory::all()->pluck('name', 'id')->toArray();

        $translationGroups = $this->language->translations()->distinct()->pluck('group')->toArray();
        $translationGroups = array_combine($translationGroups, $translationGroups);

        return [
            SelectFilter::make('translation_category_id')->label('Category')->options($translationCategories),
            SelectFilter::make('group')->label('Group')->options($translationGroups),
        ];
    }

    public static function getDefaultTitle(): string
    {
        return __('Translation');
    }

}
