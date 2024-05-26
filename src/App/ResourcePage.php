<?php 

namespace Raakkan\Yali\App;

use Livewire\Component;
use Illuminate\Http\Request;

class ResourcePage extends Component
{
    public $resource;
    protected $view = 'yali::pages.resource-page';
    public $model;

    public function mount(Request $request)
    {
        $this->resource = $request->route('resource');
    }
    public function render()
    {
        return view($this->view)->layout('yali::layouts.app');
    }

}
