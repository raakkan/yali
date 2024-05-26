<?php

namespace Raakkan\Yali\Core\Concerns;

trait Stylable
{
    protected $styles;

    protected $classes;

    public function getStyles()
    {
        return $this->styles ?? '';
    }

    public function getStylesArray()
    {
        if (empty($this->styles)) {
            return [];
        }

        $stylesArray = [];
        $styles = explode(';', $this->styles);
        foreach ($styles as $style) {
            $style = trim($style);
            if (!empty($style)) {
                [$property, $value] = explode(':', $style);
                $stylesArray[trim($property)] = trim($value);
            }
        }

        return $stylesArray;
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
        return $this->classes ?? '';
    }

    public function getClassesArray()
    {
        if (empty($this->classes)) {
            return [];
        }

        return explode(' ', $this->classes);
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
