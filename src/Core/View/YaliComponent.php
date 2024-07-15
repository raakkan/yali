<?php

namespace Raakkan\Yali\Core\View;

use Illuminate\Support\HtmlString;

abstract class YaliComponent
{
    protected $view;

    protected $viewData = [];

    protected $uniqueKey;

    protected $componentName;

    protected $beforeRenderCallbacks = [];

    protected $disabled = false;

    protected $disableIfCallbacks = [];

    protected $dontRender = false;

    protected $dontRenderIfCallbacks = [];

    protected $id;

    public function render()
    {
        $this->callBeforeRenderCallbacks();
        $this->callDisableIfCallbacks();
        $this->callDontRenderIfCallbacks();

        if ($this->dontRender) {
            return new HtmlString('');
        }

        $view = $this->getView();

        if (is_callable($view)) {
            $result = call_user_func($view, $this->getViewData());

            if ($result instanceof \Illuminate\Contracts\View\View) {
                $html = $result->render();
            } elseif (is_string($result)) {
                $html = $result;
            } else {
                throw new \InvalidArgumentException('The callable must return a view or view string.');
            }

            return new HtmlString($html);
        } else {
            return view($view, $this->getViewData());
        }
    }

    public function setViewData($viewData)
    {
        $this->viewData = $viewData;

        return $this;
    }

    public function view($view)
    {
        if (is_callable($view)) {
            $this->view = $view;
        } else {
            $this->view = function () use ($view) {
                return $view;
            };
        }

        return $this;
    }

    public function getView()
    {
        if (is_callable($this->view)) {
            return $this->view;
        } elseif (view()->exists($this->view)) {
            return $this->view;
        } else {
            throw new \InvalidArgumentException("Invalid view specified: {$this->view}");
        }
    }

    public function getViewData()
    {
        return array_merge($this->viewData, [
            $this->getComponentName() => $this,
            'id' => $this->getId(),
        ]);
    }

    public function getComponentName()
    {
        return isset($this->componentName) ? $this->componentName : 'class';
    }

    protected function generateUniqueKey()
    {
        if (! $this->uniqueKey) {
            $this->uniqueKey = md5(get_class($this).'_'.uniqid());
        }
    }

    public function getUniqueKey()
    {
        return $this->uniqueKey;
    }

    protected function initializeTraits()
    {
        foreach (class_uses_recursive($this) as $trait) {
            if (method_exists($this, $method = 'initialize'.class_basename($trait))) {
                $this->{$method}($this);
            }
        }
    }

    public function beforeRender($callback)
    {
        $this->beforeRenderCallbacks[] = $callback;

        return $this;
    }

    protected function callBeforeRenderCallbacks()
    {
        foreach ($this->beforeRenderCallbacks as $callback) {
            call_user_func($callback, $this);
        }
    }

    protected function generateComponentId()
    {
        $componentName = $this->getComponentName().'-';
        $instanceId = null;

        if (method_exists($this, 'getInstanceId')) {
            $instanceId = $this->getInstanceId();
        }

        if (! is_null($instanceId)) {
            $this->id = $componentName.'component-'.$instanceId;
        } else {
            $this->id = $componentName.'component-'.uniqid();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getClassName()
    {
        return get_class($this);
    }

    public function disableIf($callback)
    {
        $this->disableIfCallbacks[] = $callback;

        return $this;
    }

    protected function callDisableIfCallbacks()
    {
        foreach ($this->disableIfCallbacks as $callback) {
            if (call_user_func($callback, $this)) {
                $this->disabled = true;
            }
        }
    }

    public function isDisabled()
    {
        return $this->disabled;
    }

    public function disable()
    {
        $this->disabled = true;

        return $this;
    }

    public function dontRenderIf($callback)
    {
        $this->dontRenderIfCallbacks[] = $callback;

        return $this;
    }

    protected function callDontRenderIfCallbacks()
    {
        foreach ($this->dontRenderIfCallbacks as $callback) {
            if (call_user_func($callback, $this)) {
                $this->dontRender = true;
            }
        }
    }

    public function isDontRender()
    {
        return $this->dontRender;
    }
}
