<?php 

namespace Raakkan\Yali\Core\View;

use Illuminate\Support\HtmlString;

abstract class YaliComponent
{
    protected $view;

    protected $viewData = [];

    public function render()
    {
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
            'class' => $this
        ]);
    }

    public function getUniqueKey()
    {
        return md5(get_class($this) . '_' . uniqid());
    }

    protected function initializeTraits()
    {
        foreach (class_uses_recursive($this) as $trait) {
            if (method_exists($this, $method = 'initialize' . class_basename($trait))) {
                $this->{$method}($this);
            }
        }
    }
}
