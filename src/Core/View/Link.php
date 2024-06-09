<?php

namespace Raakkan\Yali\Core\View;

use Illuminate\Support\Facades\Blade;

class Link extends BaseComponent
{
    private $url;
    private $target;

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    public function render()
    {
        $classString = $this->getClasses() !== '' ? $this->getClasses() : 'link';
        $styleString = $this->getStyles() !== '' ? 'style="' . $this->getStyles() . '"' : '';
        
        $html = '<a href="' . $this->url . '" class="' . $classString . '" ' . $styleString;
        
        if ($this->target !== null) {
            $html .= ' target="' . $this->target . '"';
        }
        
        foreach ($this->attributes as $attribute => $value) {
            $html .= ' ' . $attribute . '="' . $value . '"';
        }
        
        $html .= '>';
        
        if ($this->icon !== null) {
            $html .= Blade::render('<x-yali::icon name="' . $this->icon . '" />');
        }
        
        if ($this->label !== null) {
            $html .= $this->label;
        }
        
        $html .= '</a>';
        
        return $html;
    }
}
