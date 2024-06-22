<?php

namespace Raakkan\Yali\Core\View;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;

class InfoMessage extends BaseComponent
{
    private $type = 'info';
    private $dismissible = false;
    private $message;

    public function __construct($message = '', $type = 'info', $dismissible = false)
    {
        $this->type = $type;
        $this->dismissible = $dismissible;
        $this->message = $message;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setDismissible($dismissible)
    {
        $this->dismissible = $dismissible;
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    public function danger()
    {
        $this->type = 'danger';
        return $this; 
    }

    public function success()
    {
        $this->type = 'success';
        return $this; 
    }

    public function info()
    {
        $this->type = 'info';
        return $this; 
    }

    public function warning()
    {
        $this->type = 'warning';
        return $this; 
    }

    // TODO: need to improve message render styling
    public function render()
    {
        $classString = 'alert alert-' . $this->type;
        $classString .= $this->dismissible ? ' alert-dismissible' : '';
        $styleString = $this->getStyles() !== '' ? 'style="' . $this->getStyles() . '"' : '';

        $html = '<div class="' . $classString . '" ' . $styleString;

        foreach ($this->attributes as $attribute => $value) {
            $html .= ' ' . $attribute . '="' . $value . '"';
        }

        $html .= '>';

        if ($this->dismissible) {
            $html .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        }

        if ($this->icon !== null) {
            $html .= Blade::render('<x-yali::icon name="' . $this->icon . '" />');
        }

        if ($this->label !== null) {
            $html .= '<strong>' . $this->label . '</strong> ';
        }

        if ($this->message !== null) {
            $html .= new HtmlString($this->message);
        }

        $html .= '</div>';

        return $html;
    }
}
