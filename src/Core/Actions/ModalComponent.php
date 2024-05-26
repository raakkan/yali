<?php

namespace Raakkan\Yali\Core\Actions;

use Livewire\Component;

class ModalComponent extends Component
{
    public $button = null;
    public $dataSourceKey = null;
    public function mount($data)
    {
        if (is_array($data) && array_key_exists('form', $data) && array_key_exists('source_key', $data)) {
            $this->setModalData($data);
            if (array_key_exists('button', $data)) {
                $this->button = $data['button'];
            }
        }
    }

    public function setModalData($data)
    {
        $this->dataSourceKey = $data['source_key'];
        app(ModalComponentDataHolder::class)->add($this->dataSourceKey, $data);
    }

    public function getModalData()
    {
        return app(ModalComponentDataHolder::class)->get($this->dataSourceKey);
    }

    public function getForm()
    {
        return $this->getModalData()['form'];
    }

    public function render()
    {
        // dd($this->getForm());

        return view('yali::actions.modal-component');
    }
}
