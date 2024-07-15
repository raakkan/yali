<?php

namespace Raakkan\Yali\Core\Support\Concerns\Components;

use Raakkan\Yali\Core\View\Components\Label;

trait HasLabel
{
    protected $label;

    protected $labelComponent;

    protected $labelComponentCallback;

    public $disableLabel = false;

    protected $labelPosition = 'top-left';

    protected $validPositions = ['top-left', 'top-right', 'top-center', 'bottom-left', 'bottom-right', 'bottom-center', 'left', 'right'];

    public function initializeHasLabel()
    {
        Label::macro('withErrorClasses', function ($hasError = true) {
            $errorClasses = $hasError ? 'text-red-500' : '';
            $this->withAttributes(['class' => $errorClasses]);

            return $this;
        });

        $component = Label::make()->setFor($this->getName());
        $this->labelComponent = $component;
    }

    public function getLabelComponent()
    {
        if ($this->labelComponentCallback) {
            call_user_func($this->labelComponentCallback, $this->labelComponent);
        }

        return $this->labelComponent->setLabel($this->getLabel());
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function label($label)
    {
        $this->label = $label;

        return $this;
    }

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function hasLabel()
    {
        return ! empty($this->label);
    }

    public function disableLabel()
    {
        $this->disableLabel = true;

        return $this;
    }

    public function enableLabel()
    {
        $this->disableLabel = false;

        return $this;
    }

    public function getLabelPosition()
    {
        return $this->labelPosition;
    }

    public function setLabelPosition($labelPosition)
    {
        if (! in_array($labelPosition, $this->validPositions)) {
            $labelPosition = 'top-left';
        }

        $this->labelPosition = $labelPosition;

        return $this;
    }

    public function labelPosition($labelPosition)
    {
        $this->setLabelPosition($labelPosition);

        return $this;
    }

    public function customizeLabel(callable $callback)
    {
        $this->labelComponentCallback = $callback;

        return $this;
    }
}
