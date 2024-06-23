<?php

namespace Raakkan\Yali\Core\Forms;

use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\Concerns\HasTitles;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Concerns\UI\Colorable;
use Raakkan\Yali\Core\Concerns\UI\Spaceable;
use Raakkan\Yali\Core\Concerns\UI\Borderable;
use Raakkan\Yali\Core\Concerns\UI\Layoutable;
use Raakkan\Yali\Core\Forms\Concerns\HasFormFields;
use Raakkan\Yali\Core\Concerns\Livewire\HasLivewire;
use Raakkan\Yali\Core\Forms\Concerns\HasFormActions;
use Raakkan\Yali\Core\Forms\Concerns\HasFormMessages;
use Raakkan\Yali\Core\Forms\Concerns\HasSubmitButton;
use Raakkan\Yali\Core\Forms\Concerns\HasFormSubmission;

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
