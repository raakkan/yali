<?php

namespace Raakkan\Yali\Core\Forms;

use Raakkan\Yali\Core\Forms\Concerns\HasFormActions;
use Raakkan\Yali\Core\Forms\Concerns\HasFormFields;
use Raakkan\Yali\Core\Forms\Concerns\HasFormMessages;
use Raakkan\Yali\Core\Forms\Concerns\HasFormSubmission;
use Raakkan\Yali\Core\Forms\Concerns\HasSubmitButton;
use Raakkan\Yali\Core\Forms\Concerns\HasWireModel;
use Raakkan\Yali\Core\Support\Concerns\HasTitles;
use Raakkan\Yali\Core\Support\Concerns\Livewire\HasLivewire;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Support\Concerns\UI\Borderable;
use Raakkan\Yali\Core\Support\Concerns\UI\Colorable;
use Raakkan\Yali\Core\Support\Concerns\UI\Layoutable;
use Raakkan\Yali\Core\Support\Concerns\UI\Spaceable;
use Raakkan\Yali\Core\Support\Concerns\UI\Stylable;
use Raakkan\Yali\Core\View\YaliComponent;

class YaliForm extends YaliComponent
{
    use Borderable;
    use Colorable;
    use HasFormActions;
    use HasFormFields;
    use HasFormMessages;
    use HasFormSubmission;
    use HasLivewire;
    use HasSubmitButton;
    use HasTitles;
    use HasWireModel;
    use Layoutable;
    use Makable;
    use Spaceable;
    use Stylable;

    protected $componentName = 'form';

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
        return ! empty($this->model);
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
        return ! empty($this->getModalPosition());
    }
}
