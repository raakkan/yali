<?php

namespace Raakkan\Yali\App;

use Livewire\WithPagination;
use Raakkan\Yali\Models\Language;
use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Filters\DateFilter;
use Raakkan\Yali\Core\Forms\Fields\TextField;
use Raakkan\Yali\Core\Resources\BaseResource;
use Raakkan\Yali\Core\Forms\Fields\SelectField;
use Raakkan\Yali\Core\Forms\Fields\TextareaField;
use Raakkan\Yali\Core\Concerns\Livewire\HasSearch;
use Raakkan\Yali\Core\Concerns\Livewire\HasFilters;
use Raakkan\Yali\Core\Concerns\Livewire\HasRecords;
use Raakkan\Yali\Core\Resources\Actions\EditAction;
use Raakkan\Yali\Core\Resources\Actions\CreateAction;
use Raakkan\Yali\Core\Resources\Actions\DeleteAction;
use Raakkan\Yali\Core\Concerns\Livewire\HasPagination;
use Raakkan\Yali\Core\Support\Enums\Css\LayoutMaxWidth;

class ManageTranslationPage extends BaseResource
{
    use WithPagination;
    use HasPagination;
    use HasRecords;
    use HasSearch;
    use HasFilters;

    public Language $language;
    protected static $model = \Raakkan\Yali\Models\Translation::class;
    protected static $view = 'yali::pages.manage-translation-page';

    public $searchColumns = ['key', 'group'];

    public function mount()
    {
        $this->setFilterInputs();
    }

    public static function form(YaliForm $form): YaliForm
    {
        return $form->fields([
            SelectField::make('translation_category_id')->required()->relationship(
                name: 'translationCategory',
                valueAttribute: 'id',
                labelAttribute: 'name',
            )->colSpan(2)->placeholder('Select a category')->label('Category'),
            SelectField::make('group')->required()->options(
                fn () => \Raakkan\Yali\Models\Translation::getGroups()
            )->placeholder('Select a group')->createNewOption(),
            TextField::make('key')->required(),
            TextareaField::make('value')->required()->colSpan(2),
            TextareaField::make('note')->colSpan(2),
        ])->maxWidth(LayoutMaxWidth::XL)->gridColumns(2);
    }

    public static function actions()
    {
        return [
            CreateAction::make()->modal()->action(function ($action, $model, $data) {
                if ($action->hasAdditionalData()) {
                    $languageCode = $action->getAdditionalData()['language_code'];
                    $language = Language::where('code', $languageCode)->first();

                    if ($language) {
                        $data['language_code'] = $language->code;

                        foreach($data as $key => $value) {
                            $model->{$key} = $value;
                        }

                        $model->language()->associate($language);
                        $model->save();

                        return $model;
                    }else {
                        throw new \Exception('No language found');
                    }

                }else {
                    throw new \Exception('No language code provided');
                }
            }),
            EditAction::make()->modal(),
            DeleteAction::make(),
        ];
    }

    public function getFilters()
    {
        return [DateFilter::make('created_at')->label('Created At'),];
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
