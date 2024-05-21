<?php 

namespace Raakkan\Yali\Core\Resources\Actions;

use Raakkan\Yali\Core\Actions\YaliAction;

class DeleteAction extends YaliAction
{
    public function __construct()
    {
    }

    public function handle($model)
    {
        // Implement the handle method here
    }

    public function render($data)
    {
        return view('yali::actions.delete-action', [
            'data' => $data
        ]);
    }
}
