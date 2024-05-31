<?php

namespace Raakkan\Yali\App;

use Livewire\Component;
use Livewire\WithPagination;
use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Models\TranslationCategory;

class ManageTranslationPage extends Component
{
    use WithPagination;

    public Language $language;
    protected $view = 'yali::pages.manage-translation-page';

    public $translationCategories;
    public $selectedCategory = 'all';

    public function mount()
    {
        $translationCategories = TranslationCategory::all()->pluck('name', 'id')->toArray();

        $translationCategories['all'] = 'All';

        $this->translationCategories = $translationCategories;
    }

    public function updatedSelectedCategory($value)
    {
        $this->resetPage();
    }

    public function render()
    {
        $translations = $this->language->translations();

        if ($this->selectedCategory !== 'all') {
            $translations->where('translation_category_id', $this->selectedCategory);
        }

        $translations = $translations->paginate(20);

        return view($this->view, [
            'translations' => $translations,
        ])->layout('yali::layouts.app');
    }
}
