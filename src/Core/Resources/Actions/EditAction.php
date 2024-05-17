<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;

class EditAction extends YaliAction
{
    public function __construct()
    {
        parent::__construct(
            label: 'Edit',
            class: 'font-medium text-blue-600 dark:text-blue-500 hover:underline',
            icon: '',
            visible: true,
            confirmationMessage: '',
            permission: 'edit'
        );
    }

    public function render($data): string
    {
        return '<a href="' . route('admin.resource.edit', ['resourceId' => request()->route('resourceId'), 'id' => $data['id']]) . '">' . $this->getLabel() . '</a>';
    }
}
