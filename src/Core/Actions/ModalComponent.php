<?php

namespace Raakkan\Yali\Core\Actions;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Raakkan\Yali\Core\Forms\Concerns\InteractsWithForms;
use Raakkan\Yali\Core\Forms\Contracts\HasForms;
use Raakkan\Yali\Core\Forms\YaliForm;

class ModalComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public $form;

    protected $button; 

    public $dataSourceKey = null;
    
    public function mount($data)
    {
        $this->form = YaliForm::class;

        if (is_array($data) && array_key_exists('form', $data) && array_key_exists('source_key', $data)) {
            // $this->setForm($data['form']);
            $this->model = $data['model'];
            $this->button = $data['button'];
            // $this->fillForm();
        }
    }

    public function setForm(YaliForm $form)
    {
        $this->forms[] = $form;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getButton()
    {
        return $this->button;
    }

    public function submit()
    {
        $validatedData = $this->validatedInputs();
    }

    public function render()
    {
        // Log::info($this->__id);

        return view('yali::actions.modal-component');
    }
}
