<?php

namespace Raakkan\Yali\Core\Forms\Concerns;

trait HasFormSubmission
{
    protected $formSubmitMethod = 'submit';

    protected $submitCallback;

    protected $beforeFormSubmitCallback;

    protected $afterFormSubmitCallback;

    public function getFormSubmitMethod()
    {
        return $this->formSubmitMethod;
    }

    public function setFormSubmitMethod($method)
    {
        $this->formSubmitMethod = $method;

        return $this;
    }

    public function formSubmit($data, $model)
    {
        if ($this->beforeFormSubmitCallback) {
            call_user_func($this->beforeFormSubmitCallback, $data, $model);
        }

        if ($this->hasCustomSubmitCallback()) {
            $result = call_user_func($this->submitCallback, $data, $model);
        } else {
            if (is_null($model->id)) {
                $result = $model->create($data);
            } else {
                $model->update($data);
                $result = $model;
            }
        }

        if ($this->afterFormSubmitCallback) {
            call_user_func($this->afterFormSubmitCallback, $data, $model, $result);
        }

        return $result;
    }

    public function submit(callable $callback)
    {
        $this->submitCallback = $callback;

        return $this;
    }

    public function hasCustomSubmitCallback()
    {
        return $this->submitCallback !== null;
    }

    public function beforeFormSubmit(callable $callback)
    {
        $this->beforeFormSubmitCallback = $callback;

        return $this;
    }

    public function afterFormSubmit(callable $callback)
    {
        $this->afterFormSubmitCallback = $callback;

        return $this;
    }
}
