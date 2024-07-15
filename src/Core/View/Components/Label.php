<?php

namespace Raakkan\Yali\Core\View\Components;

class Label extends BaseComponent
{
    private $for;

    public function __construct($label = null, $for = null)
    {
        $this->label = $label;
        $this->for = $for;
    }

    public function setFor($for)
    {
        $this->for = $for;

        return $this;
    }

    public function render()
    {
        $classString = $this->getClasses() !== '' ? $this->getClasses() : 'label';
        $styleString = $this->getStyles() !== '' ? 'style="'.$this->getStyles().'"' : '';

        $html = '<label';

        if ($this->for !== null) {
            $html .= ' for="'.$this->for.'"';
        }

        $html .= ' class="'.$classString.'" '.$styleString;

        foreach ($this->attributes as $attribute => $value) {
            $html .= ' '.$attribute.'="'.$value.'"';
        }

        $html .= '>';
        $html .= $this->label;
        $html .= '</label>';

        return $html;
    }
}
