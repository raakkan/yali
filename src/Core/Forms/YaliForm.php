<?php

namespace Raakkan\Yali\Core\Forms;

use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\Concerns\HasTitles;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Concerns\UI\Colorable;
use Raakkan\Yali\Core\Concerns\UI\Spaceable;
use Raakkan\Yali\Core\Database\ModelManager;
use Raakkan\Yali\Core\Concerns\UI\Borderable;
use Raakkan\Yali\Core\Concerns\UI\Layoutable;
use Raakkan\Yali\Core\Forms\Concerns\HasFormFields;
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

    protected $componentName  = 'form';

    protected $view = 'yali::forms.form';
    protected $modelManager;

    public function __construct($model = null)
    {
        $this->modelManager = new ModelManager($model);
    }

    public function getModel()
    {
        return $this->modelManager->getModel();
    }

    public function setModel($model)
    {
        $this->modelManager->setModel($model);
        return $this;
    }

    public function getRounded()
    {
        if ($this->rounded === null) {
            return 'rounded-lg';
        }
        return $this->rounded;
    }
}
