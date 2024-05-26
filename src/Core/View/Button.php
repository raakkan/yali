<?php

namespace Raakkan\Yali\Core\View;

class Button
{
    private $class;
    private $label;
    private $icon;
    private $link;
    private $disabled;

    public function __construct($class = null, $label = null, $icon = null, $link = null, $disabled = false)
    {
        $this->class = $class;
        $this->label = $label;
        $this->icon = $icon;
        $this->link = $link;
        $this->disabled = $disabled;
    }

    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function render()
    {
        $classString = ($this->class !== null && $this->class->getClasses() !== '') ? $this->class->getClasses() : 'btn btn-primary';
        
        $html = '<button class="' . $classString . '"';
        
        if ($this->disabled) {
            $html .= ' disabled';
        }
        
        $html .= '>';
        
        if ($this->icon !== null) {
            $html .= '<x-yali::icon name="' . $this->icon . '" />';
        }
        
        if ($this->label !== null) {
            $html .= $this->label;
        }
        
        $html .= '</button>';
        
        return $html;
    }
}
