<?php

namespace Raakkan\Yali\Core\View;

use Illuminate\Support\Facades\Blade;

class Button extends BaseComponent
{
    private $disabled;
    private $tag = 'button';
    private $type = 'button';
    private $url;
    private $target;

    private $spinner = false;
    private $spinnerTarget = null;

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

    public function setSpinner($spinner = true, $target = null)
    {
        $this->spinner = $spinner;
        $this->spinnerTarget = $target;
        return $this;
    }

    public function setLink()
    {
        $this->tag = 'a';
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        $this->tag = 'a';
        return $this;
    }

    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    public function render()
    {
        $classString = $this->getClasses() !== '' ? $this->getClasses() . ' ' . $this->getTextColor() . ' ' . $this->getColor() : 'btn btn-primary ' . $this->getTextColor() . ' ' . $this->getColor();
        $styleString = $this->getStyles() !== '' ? 'style="' . $this->getStyles() . '"' : '';
        
        $html = '<' . $this->tag;
        
        if ($this->tag === 'a') {
            $html .= ' href="' . $this->url . '"';
        } else {
            $html .= ' type="' . $this->type . '"';
        }
        
        $html .= ' class="' . $classString . '" ' . $styleString;
        
        if ($this->disabled) {
            $html .= ' disabled';
        }
        
        foreach ($this->attributes as $attribute => $value) {
            $html .= ' ' . $attribute . '="' . $value . '"';
        }

        if ($this->spinner) {
            $html .= ' wire:loading.attr="disabled" wire:target="' . $this->spinnerTarget .'"';
        }
        
        if ($this->target !== null) {
            $html .= ' target="' . $this->target . '"';
        }
        
        $html .= '>';

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
}
