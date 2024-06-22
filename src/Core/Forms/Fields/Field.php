<?php

namespace Raakkan\Yali\Core\Forms\Fields;

use Illuminate\Support\Str;
use Raakkan\Yali\Core\Concerns\Makable;
use Illuminate\Contracts\Validation\Rule;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Forms\Concerns\HasColSpan;
use Raakkan\Yali\Core\Forms\Concerns\HasValidation;
use Raakkan\Yali\Core\Concerns\Livewire\HasLivewire;

// encrypt and decrypt
abstract class Field extends YaliComponent
{
    use Makable;
    use HasValidation;
    use Stylable;
    use HasLivewire;
    use HasColSpan;

    protected $componentName = 'field';
    public $name;

    public $label;

    public $default;

    public $placeholder;

    protected $type = '';

    public $infoMessage;
    public $disableLabel = false;
    public $formId;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function label($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel()
    {
        if($this->disableLabel) {
            return '';
        }
        
        return $this->label ?? Str::of($this->name)->replace('_', ' ')->title();
    }

    public function disableLabel()
    {
        $this->disableLabel = true;
        return $this;
    }

    public function default($default)
    {
        $this->default = $default;
        return $this;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function getName()
    {
        return $this->name;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function getPlaceholder()
    {
        $placeholder = $this->placeholder;

        if (empty($placeholder)) {
            $placeholder = isset($this->label) ?? 'Enter ' . Str::of($this->label)->replace('_', ' ')->title();
        }

        if (empty($placeholder)) {
            $placeholder = 'Enter ' . Str::of($this->name)->replace('_', ' ')->title();
        }

        if (empty($placeholder)) {
            $placeholder = '';
        }

        return $placeholder;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function infoMessage($message)
    {
        $this->infoMessage = $message;
        return $this;
    }

    public function getInfoMessage()
    {
        return $this->infoMessage;
    }

     public function getFormId()
     {
         return $this->formId;
     }

      public function setFormId($formId)
      {
         $this->formId = $formId;
         return $this;
      }

    public function getLivewireData()
    {
        if ($this->hasLivewire()) {
            return $this->livewire->inputs[$this->formId][$this->getName()];
        }

        return null;
    }
}
