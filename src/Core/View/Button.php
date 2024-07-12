<?php

namespace Raakkan\Yali\Core\View;

use Illuminate\Support\Facades\Blade;
use Raakkan\Yali\Core\Concerns\UI\Iconable;
use Raakkan\Yali\Core\View\Components\BaseComponent;

class Button extends BaseComponent
{
    use Iconable;

    private $disabled;
    private $tag = 'button';
    private $type = 'button';
    private $url;
    private $target;

    private $spinner = false;
    private $spinnerTarget = null;
    private $loadingLabel = 'Loading...';

    public function setDisabled($disabled = true)
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

    public function setLoadingLabel($loadingLabel)
    {
        $this->loadingLabel = $loadingLabel;
        return $this;
    }

    public function render()
    {
        $classString = $this->getClasses() !== '' ? $this->getClasses() : 'btn btn-primary';
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
            $html .= ' wire:loading.attr="disabled" wire:target="' . $this->spinnerTarget . '"';
        }
        
        if ($this->target !== null) {
            $html .= ' target="' . $this->target . '"';
        }
        
        $html .= '>';

        if ($this->spinner)
        {
            $html .= Blade::render('<x-yali::icon name="spinner" wire:loading wire:target="' . $this->spinnerTarget .'" class="inline w-4 h-4 me-3 animate-spin" />');
        }
        
        if ($this->hasIcon()) {
            $html .= $this->getIconView();
        }
        
        if ($this->spinner && $this->loadingLabel) {
            $html .= Blade::render('<span wire:loading wire:target="' . $this->spinnerTarget . '">' . $this->loadingLabel . '</span>');
            $html .= Blade::render('<span wire:loading.remove wire:target="' . $this->spinnerTarget . '">' . $this->label . '</span>');
        } else {
            $html .= $this->label;
        }

        $html .= '</' . $this->tag . '>';
        
        return $html;
    }
}
