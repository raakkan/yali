<?php 

namespace Raakkan\Yali\Core\Forms;

use Raakkan\Yali\Core\View\YaliComponent;

use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Concerns\UI\Colorable;
use Raakkan\Yali\Core\Concerns\UI\Spaceable;
use Raakkan\Yali\Core\Concerns\UI\Borderable;
use Raakkan\Yali\Core\Concerns\UI\Layoutable;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;

class YaliForm extends YaliComponent
{
    use Stylable;
    use Layoutable;
    use Borderable;
    use Colorable;
    use Spaceable;
    use Modalable;

    protected $view = 'yali::forms.form';
    protected $fields = [];

    public function fields($fields)
    {
        $this->fields = $fields;
        return $this;  
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getValidationRules()
    {
        $validationRules = [];

        foreach ($this->fields as $field) {
            $validationRules[$field->getName()] = $field->getValidationRules();
        }

        return $validationRules;
    }

    public function getRounded()
    {
        if ($this->rounded === null) {
            return 'rounded-lg';
        }
        return $this->rounded;
    }
}
