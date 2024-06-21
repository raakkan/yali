<?php

namespace Raakkan\Yali\Core\Actions;

use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Concerns\UI\Stylable;
use Raakkan\Yali\Core\Actions\Concerns\HasLink;
use Raakkan\Yali\Core\Actions\Concerns\HasLabel;
use Raakkan\Yali\Core\Actions\Concerns\HasSource;
use Raakkan\Yali\Core\Actions\Concerns\HasWizard;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;
use Raakkan\Yali\Core\Concerns\Database\HasModel;
use Raakkan\Yali\Core\Concerns\Components\HasButton;
use Raakkan\Yali\Core\Actions\Concerns\HasActionForm;
use Raakkan\Yali\Core\Actions\Concerns\HasHeaderActions;
use Raakkan\Yali\Core\Actions\Concerns\ModalConfirmation;
use Raakkan\Yali\Core\Actions\Concerns\HasActionSuccessMessages;

abstract class YaliAction extends YaliComponent
{
    use Makable;
    use Stylable;
    use Modalable;
    use HasLabel;
    use HasLink;
    use HasButton;
    use HasModel;
    use HasHeaderActions;
    use HasSource;
    use HasWizard;
    use ModalConfirmation;
    use HasActionSuccessMessages;
    use HasActionForm;

    protected $componentName = 'action';

    protected $view = 'yali::actions.action';

    protected $action;

    protected $beforeExecuteCallback;

    protected $afterExecuteCallback;

    public function buttonAttributes()
    {
        return [
            'wire:key' => 'action-button-'. $this->getUniqueKey(),
        ];
    }

    public function execute($formData = null)
    {
        try {
            $formData = $this->runCallback($this->beforeExecuteCallback, $this, $this->getModel(), $formData);

            if (is_callable($this->action)) {
                $result = call_user_func($this->action, $this->getModel(), $formData);
            }

            $result = $this->runCallback($this->afterExecuteCallback, $this, $this->getModel(), $formData, $result);

            return $result;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    protected function runCallback($callback, $action, $model, $formData, $result = null)
    {
        if (is_callable($callback)) {
            return call_user_func($callback, $action, $this->getModel(), $formData, $result);
        }

        return $result ?? $formData;
    }

    public function action($action = null)
    {
        if (is_callable($action)) {
            $this->action = $action;
        }

        return $this;
    }

    public function beforeExecute(callable $callback)
    {
        $this->beforeExecuteCallback = $callback;
        return $this;
    }

    public function afterExecute(callable $callback)
    {
        $this->afterExecuteCallback = $callback;
        return $this;
    }
}
