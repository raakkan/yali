<?php

namespace Raakkan\Yali\Core\Actions\Traits;


trait Stylable
{
    protected $styles;

    protected $classes;

    public function getStyles()
    {
        return $this->styles;
    }

    public function styles($styles)
    {
        $style = '';
        foreach ($styles as $property => $value) {
            $style .= $property . ': ' . $value . '; ';
        }

        $this->styles = trim($style);
        return $this;
    }

    public function getClasses()
    {
        return $this->classes;
    }

    public function classes($classes)
    {
        $class = '';
        foreach ($classes as $item) {
            if ($item instanceof \BackedEnum) {
                $class .= $item->value . ' ';
            }
            if (is_string($item)) {
                $class .= $item . ' ';
            }
        }
    
        $this->classes = trim($class);
        return $this;
    }
    
}
