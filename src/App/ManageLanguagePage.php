<?php

namespace Raakkan\Yali\App;

use Livewire\Component;

class ManageLanguagePage extends Component
{
    protected $view = 'yali::pages.manage-language-page';

    public function render()
    {
        return view($this->view)->layout('yali::layouts.app');
    }
}