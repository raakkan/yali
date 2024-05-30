<?php

namespace Raakkan\Yali\App;

use Livewire\Component;
use Raakkan\Yali\Models\Language;

class ManageLanguagePage extends Component
{
    protected $view = 'yali::pages.manage-language-page';

    public function mount(Language $language)
    {
        // dd($language);
    }

    public function render()
    {
        return view($this->view)->layout('yali::layouts.app');
    }
}