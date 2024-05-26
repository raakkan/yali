<?php

namespace Raakkan\Yali\App;

use Livewire\Component;

class ManageTranslationPage extends Component
{
    protected $view = 'yali::pages.manage-translation-page';

    public function render()
    {
        return view($this->view)->layout('yali::layouts.app');
    }
}