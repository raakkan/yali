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

    public function addStyle($property, $value)
    {
        $existingStyles = $this->getStylesArray();
        $existingStyles[$property] = $value;
        
        return $this->styles($existingStyles);
    }

    public function updateStyle($property, $value)
    {
        $existingStyles = $this->getStylesArray();
        
        if (array_key_exists($property, $existingStyles)) {
            $existingStyles[$property] = $value;
        }
        
        return $this->styles($existingStyles);
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

    public function hasClass($class)
    {
        $existingClasses = $this->getClassesArray();
        
        return in_array($class, $existingClasses);
    }

    public function addClass($class)
    {
        if (!$this->hasClass($class)) {
            $existingClasses = $this->getClassesArray();
            $existingClasses[] = $class;
            
            return $this->classes($existingClasses);
        }
        
        return $this;
    }

    public function updateClass($oldClass, $newClass)
    {
        $existingClasses = $this->getClassesArray();
        
        if (($key = array_search($oldClass, $existingClasses)) !== false) {
            $existingClasses[$key] = $newClass;
            
            return $this->classes($existingClasses);
        }
        
        return $this;
    }

    public function removeClass($class)
    {
        $existingClasses = $this->getClassesArray();
        
        if (($key = array_search($class, $existingClasses)) !== false) {
            unset($existingClasses[$key]);
            
            return $this->classes($existingClasses);
        }
        
        return $this;
    }

    public function removeStyle($property)
    {
        $existingStyles = $this->getStylesArray();
        
        if (array_key_exists($property, $existingStyles)) {
            unset($existingStyles[$property]);
        }
        
        return $this->styles($existingStyles);
    }
}
