<?php

namespace Raakkan\Yali\Core\Forms\Fields;

use Illuminate\Support\Str;
use Raakkan\Yali\Core\Forms\Concerns\HandlesFieldRelationship;
use Raakkan\Yali\Core\Forms\Concerns\HasColSpan;
use Raakkan\Yali\Core\Forms\Concerns\HasFieldValue;
use Raakkan\Yali\Core\Forms\Concerns\HasValidation;
use Raakkan\Yali\Core\Forms\Concerns\HasWireModel;
use Raakkan\Yali\Core\Support\Concerns\Components\HasLabel;
use Raakkan\Yali\Core\Support\Concerns\HasName;
use Raakkan\Yali\Core\Support\Concerns\HasPlaceholder;
use Raakkan\Yali\Core\Support\Concerns\Livewire\HasLivewire;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Support\Concerns\UI\Stylable;
use Raakkan\Yali\Core\View\YaliComponent;

// encrypt and decrypt
abstract class Field extends YaliComponent
{
    use HandlesFieldRelationship;
    use HasColSpan;
    use HasFieldValue;
    use HasLabel { getLabel as getLabelMethod; }
    use HasLivewire;
    use HasName;
    use HasPlaceholder { getPlaceholder as getPlaceholderMethod; }
    use HasValidation;
    use HasWireModel;
    use Makable;
    use Stylable;

    protected $componentName = 'field';

    protected $type = '';

    public $infoMessage;

    public $formId;

    protected $model;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getLabel()
    {
        if ($this->disableLabel) {
            return '';
        }

        return $this->label ?? Str::of($this->name)->replace('_', ' ')->title();
    }

    public function getPlaceholder()
    {
        $placeholder = $this->placeholder;

        if (empty($placeholder)) {
            $placeholder = isset($this->label) ?? 'Enter '.Str::of($this->label)->replace('_', ' ')->title();
        }

        if (empty($placeholder)) {
            $placeholder = 'Enter '.Str::of($this->name)->replace('_', ' ')->title();
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
            return $this->livewire->form[$this->formId]['inputs'][$this->getName()];
        }

        return null;
    }

    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }
}
