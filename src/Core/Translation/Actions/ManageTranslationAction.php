<?php 

namespace Raakkan\Yali\Core\Translation\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class ManageTranslationAction extends YaliAction
{
    protected $buttonIsLink = true;

    protected string $label = 'Manage Translation';

    public function buttonClasses()
    {
        return [
            ButtonClass::LINK
        ];
    }

    public function getButtonUrl()
    {
        $this->setRouteParameters(['language' => $this->getModelIdentifier()]);
        return $this->getRoute();
    }
}
