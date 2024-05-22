<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class DeleteAction extends YaliAction
{
    protected $view = 'yali::actions.action';

    protected string $label = 'delete';

    public function __construct() {
        $this->classes([
            ButtonClass::LINK,
            'text-red-500'
        ]);
    }
}
