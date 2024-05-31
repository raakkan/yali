<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class DeleteAction extends YaliAction
{
    protected $view = 'yali::actions.action';

    protected string $label = 'Delete';

    public function __construct()
    {
        $this->classes([
            ButtonClass::LINK,
            'text-red-500'
        ]);

        $this->confirmation();
    }

    public function getPayload()
    {
        return $this->getModel()->id;
    }

    public function getConfirmationMessage()
    {
        if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($this->getModel()))) {
            if ($this->getModel()->trashed()) {
                return $this->source->getHardDeleteMessage();
            } else {
                return $this->source->getDeleteMessage();
            }
        } else {
            return $this->source->getDeleteMessage();
        }
    }

    public function getConfirmationTitle()
    {
        if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($this->getModel()))) {
            if ($this->getModel()->trashed()) {
                return $this->source->getHardDeleteTitle();
            } else {
                return $this->source->getDeleteTitle();
            }
        } else {
            return $this->source->getDeleteTitle();
        }
    }
}
