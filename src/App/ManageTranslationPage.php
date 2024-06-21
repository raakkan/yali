<?php

namespace Raakkan\Yali\App;

use Livewire\WithPagination;
use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Resources\BaseResource;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;

class ManageTranslationPage extends BaseResource
{
    use WithPagination;
    use HasPagination;
    use HasRecords;

    public Language $language;
    protected static $model = \Raakkan\Yali\Models\Translation::class;
    protected static $view = 'yali::pages.manage-translation-page';

    public function mount()
    {
        
    }

    public function getViewData()
    {
        return [
            'translations' => $this->getRecords($this->getModelQuery(), fn ($query) => $query->where('language_code', $this->language->code)),
        ];
    }

    public static function getRouteName()
    {
        return LanguagesPage::getRouteName() . '.translations';
    }

    public static function getSlug(): string
    {
        return LanguagesPage::getSlug() . '/{language}/translations';
    }
}
