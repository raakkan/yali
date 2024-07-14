<?php

namespace Raakkan\Yali\Core\Forms;

use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Support\Concerns\HasTitles;
use Raakkan\Yali\Core\Forms\Concerns\HasWireModel;
use Raakkan\Yali\Core\Forms\Concerns\HasFormFields;
use Raakkan\Yali\Core\Support\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Forms\Concerns\HasFormActions;
use Raakkan\Yali\Core\Support\Concerns\UI\Colorable;
use Raakkan\Yali\Core\Support\Concerns\UI\Spaceable;
use Raakkan\Yali\Core\Forms\Concerns\HasFormMessages;
use Raakkan\Yali\Core\Forms\Concerns\HasSubmitButton;
use Raakkan\Yali\Core\Support\Concerns\UI\Borderable;
use Raakkan\Yali\Core\Support\Concerns\UI\Layoutable;
use Raakkan\Yali\Core\Forms\Concerns\HasFormSubmission;
use Raakkan\Yali\Core\Support\Concerns\Livewire\HasLivewire;

class YaliForm extends YaliComponent
{
    use Makable;
    use Stylable;
    use Layoutable;
    use Borderable;
    use Colorable;
    use Spaceable;
    use HasFormFields;
    use HasSubmitButton;
    use HasFormSubmission;
    use HasFormActions;
    use HasTitles;
    use HasFormMessages;
    use HasLivewire;
    use HasWireModel;

    protected $componentName  = 'form';

    protected $view = 'yali::forms.form';
    protected $modelManager;

    protected $modalPosition = '';

    protected $model;

    public function getModel()
    {
        return $this->model;
    }

    public function hasModel()
    {
        return !empty($this->model);
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function setModalPosition($position)
    {
        $this->modalPosition = $position;
        return $this;
    }

    public function getModalPosition()
    {
        return $this->modalPosition;
    }

    public function isModal()
    {
        return !empty($this->getModalPosition());
    }
}
