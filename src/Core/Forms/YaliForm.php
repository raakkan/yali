<?php 

namespace Raakkan\Yali\Core\Forms;

use Raakkan\Yali\Core\Pages\YaliPage;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Concerns\UI\Colorable;
use Raakkan\Yali\Core\Concerns\UI\Spaceable;
use Raakkan\Yali\Core\Concerns\UI\Borderable;
use Raakkan\Yali\Core\Concerns\UI\Layoutable;
use Raakkan\Yali\Core\Resources\YaliResource;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;
use Raakkan\Yali\Core\Forms\Concerns\HasFormFields;
use Raakkan\Yali\Core\Forms\Concerns\HasFormActions;
use Raakkan\Yali\Core\Forms\Concerns\HasSubmitButton;
use Raakkan\Yali\Core\Forms\Concerns\HasFormSubmission;

class YaliForm extends YaliComponent
{
    use Stylable;
    use Layoutable;
    use Borderable;
    use Colorable;
    use Spaceable;
    use Modalable;
    use HasFormFields;
    use HasSubmitButton;
    use HasFormSubmission;
    use HasFormActions;

    protected $view = 'yali::forms.form';

    public function getRounded()
    {
        if ($this->rounded === null) {
            return 'rounded-lg';
        }
        return $this->rounded;
    }
}
