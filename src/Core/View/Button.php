<?php

namespace Raakkan\Yali\Core\View;
use Illuminate\Support\Facades\Blade;
use Raakkan\Yali\Core\Concerns\Makable;
use Raakkan\Yali\Core\Concerns\UI\Stylable;

class Button
{
    use Makable;
    use Stylable;
    
    private $label;
    private $icon;
    private $link;
    private $disabled;
    private $tag = 'button';
    private $type = 'button';
    private $attributes = [];

    private $spinner = false;
    private $spinnerTarget = null;


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

    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function submit()
    {
        $this->type = 'submit';
        return $this;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function setSpinner($spinner = true, $target = null)
    {
        $this->spinner = $spinner;
        $this->spinnerTarget = $target;
        return $this;
    }

    public function render()
    {
        $classString = $this->getClasses() !== '' ? $this->getClasses() : 'btn btn-primary';
        $styleString = $this->getStyles() !== '' ? 'style="' . $this->getStyles() . '"' : '';
        
        $html = '<' . $this->tag . ' type="' . $this->type . '" class="' . $classString . '" ' . $styleString;
        
        if ($this->disabled) {
            $html .= ' disabled';
        }
        
        foreach ($this->attributes as $attribute => $value) {
            $html .= ' ' . $attribute . '="' . $value . '"';
        }

        if ($this->spinner) {
            $html .= ' wire:loading.attr="disabled" wire:target="' . $this->spinnerTarget .'"';
        }
        
        $html .= ' >';

        if ($this->spinner)
        {
            $html .= Blade::render('<x-yali::icon name="spinner" wire:loading wire:target="' . $this->spinnerTarget .'" class="inline w-4 h-4 me-3 animate-spin" />');
        }
        
        if ($this->icon !== null) {
            $html .= Blade::render('<x-yali::icon name="' . $this->icon . '" />');
        }
        
        if ($this->label !== null) {
            $html .= $this->label;
        }
        
        $html .= '</' . $this->tag . '>';
        
        return $html;
    }

    public function __toString()
    {
        return $this->render();
    }
}
