<?php

namespace Raakkan\Yali\App;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Utils\RouteUtils;
use Illuminate\Support\Facades\Validator;
use Raakkan\Yali\Core\Facades\YaliManager;
use Raakkan\Yali\Core\Forms\Contracts\HasForms;
use Raakkan\Yali\Core\Forms\Concerns\InteractsWithForms;

class HandleResourcePage extends Component implements HasForms
{
    use InteractsWithForms;

    public $resource;
    protected $view = 'yali::pages.handle-resource-page';

    public $isEditing = false;

    public function mount(Request $request, $modelKey = null)
    {
        $this->resource = YaliManager::resolveResource($request->route('resource'));

        if ($modelKey) {
            $this->model = $this->getModel()->find($modelKey);
            $this->isEditing = true;
        } else {
            $this->model = $this->getModel();
            $this->isEditing = false;
        }

        $this->fillForm();
    }

    public function getResource()
    {
        $resource = $this->resource['class'];
        return new $resource();
    }

    public function getModel()
    {
        return $this->getResource()->getModelInstance();
    }

    public function getForm()
    {
        return $this->getResource()->form($this->getResource()->getForm());
    }

    public function submit()
    {
        $validatedData = $this->validatedInputs();

        if (is_null($this->model->id)) {
            $this->model = $this->getForm()->formSubmit($validatedData, $this->model);
            return redirect()->route($this->getResoureceRoute() . '.edit', ['modelKey' => $this->model->id]);
        } else {
            $this->model = $this->getForm()->formSubmit($validatedData, $this->model);
            $this->dispatch('toast', type: 'success', message: $this->getResource()->getModelName() . ' has been updated.');
        }
    }

    public function getResoureceRoute()
    {
        return $this->getResource()->getRouteName();
    }

    public function render()
    {
        return view($this->view, [
            'fields' => $this->getForm()->getFields(),
        ])->layout('yali::layouts.app');
    }
}
