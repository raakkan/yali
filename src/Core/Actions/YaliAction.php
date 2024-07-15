<?php

namespace Raakkan\Yali\Core\Actions;

use Raakkan\Yali\Core\Actions\Concerns\HasActionForm;
use Raakkan\Yali\Core\Actions\Concerns\HasActionSuccessMessages;
use Raakkan\Yali\Core\Actions\Concerns\HasAdditionalData;
use Raakkan\Yali\Core\Actions\Concerns\HasHeaderActions;
use Raakkan\Yali\Core\Actions\Concerns\HasLabel;
use Raakkan\Yali\Core\Actions\Concerns\HasLink;
use Raakkan\Yali\Core\Actions\Concerns\HasSource;
use Raakkan\Yali\Core\Actions\Concerns\HasWizard;
use Raakkan\Yali\Core\Actions\Concerns\Modalable;
use Raakkan\Yali\Core\Actions\Concerns\ModalConfirmation;
use Raakkan\Yali\Core\Support\Concerns\Components\HasButton;
use Raakkan\Yali\Core\Support\Concerns\Database\HasModel;
use Raakkan\Yali\Core\Support\Concerns\Livewire\HasLivewire;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Support\Concerns\UI\Stylable;
use Raakkan\Yali\Core\View\YaliComponent;

abstract class YaliAction extends YaliComponent
{
    use HasActionForm;
    use HasActionSuccessMessages;
    use HasAdditionalData;
    use HasButton;
    use HasHeaderActions;
    use HasLabel;
    use HasLink;
    use HasLivewire;
    use HasModel;
    use HasSource;
    use HasWizard;
    use Makable;
    use Modalable;
    use ModalConfirmation;
    use Stylable;

    protected $componentName = 'action';

    protected $view = 'yali::actions.action';

    protected $action;

    protected $beforeExecuteCallback;

    protected $afterExecuteCallback;

    public function buttonAttributes()
    {
        return [
            'wire:key' => 'action-button-'.$this->getUniqueKey(),
        ];
    }

    public function execute($form = null)
    {
        try {
            $formData = $this->runCallback($this->beforeExecuteCallback, $this, $this->getModel(), $form);

            if (is_callable($this->action)) {
                $result = call_user_func($this->action, $this, $this->getModel(), $form);
            }

            $result = $this->runCallback($this->afterExecuteCallback, $this, $this->getModel(), $form, $result);

            return $result;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    protected function runCallback($callback, $action, $model, $form, $result = null)
    {
        if (is_callable($callback)) {
            return call_user_func($callback, $action, $this->getModel(), $form, $result);
        }

        return $result ?? $form ?? $model;
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
