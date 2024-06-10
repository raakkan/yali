<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Illuminate\Support\Js;
use Raakkan\Yali\Core\Actions\YaliAction;
use Raakkan\Yali\Core\Support\Enums\Css\ButtonClass;

class DeleteAction extends YaliAction
{
    protected $view = 'yali::actions.action';

    protected string $label = 'Delete';

    public function __construct()
    {
        $this->confirmation();
    }

    public function buttonClasses()
    {
        return [
            ButtonClass::LINK,
            'text-red-500'
        ];
    }

    public function buttonAttributes()
    {
        return array_merge($this->getButton()->getAttributes(), [
            'wire:key' => 'action-button-'. $this->getUniqueKey(),
            'wire:yali-confirm' => Js::from([
                'title' => $this->getConfirmationTitle(),
                'message' => $this->getConfirmationMessage(),
                'payload' => 2
            ])->toHtml(),
            'wire:click' => 'delete'
        ]);
    }

    // public function getPayload()
    // {
    //     return $this->getModel()->id;
    // }

    // public function getConfirmationMessage()
    // {
    //     if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($this->getModel()))) {
    //         if ($this->getModel()->trashed()) {
    //             return $this->source->getHardDeleteMessage();
    //         } else {
    //             return $this->source->getDeleteMessage();
    //         }
    //     } else {
    //         return $this->source->getDeleteMessage();
    //     }
    // }

    // public function getConfirmationTitle()
    // {
    //     if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($this->getModel()))) {
    //         if ($this->getModel()->trashed()) {
    //             return $this->source->getHardDeleteTitle();
    //         } else {
    //             return $this->source->getDeleteTitle();
    //         }
    //     } else {
    //         return $this->source->getDeleteTitle();
    //     }
    // }
}
