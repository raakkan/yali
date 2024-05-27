<?php

namespace Raakkan\Yali\Core\Concerns;

/**
 * Trait Stylable
 *
 * Provides functionality to manage styles and classes for an object.
 */
trait Stylable
{
    /**
     * The inline styles of the object.
     *
     * @var string|null
     */
    protected ?string $styles = null;

    /**
     * The CSS classes of the object.
     *
     * @var string|null
     */
    protected ?string $classes = null;

    /**
     * The default inline styles of the object.
     *
     * @var array
     */
    protected array $defaultStyles = [];

    /**
     * The default CSS classes of the object.
     *
     * @var array
     */
    protected array $defaultClasses = [];

    /**
     * Get the inline styles of the object.
     *
     * @return string
     */
    public function getStyles(): string
    {
        return $this->styles ?? implode('; ', array_map(
            fn($v, $k) => $k . ':' . $v,
            $this->defaultStyles,
            array_keys($this->defaultStyles)
        ));
    }

    /**
     * Get the inline styles as an associative array.
     *
     * @return array
     */
    public function getStylesArray(): array
    {
        if (empty($this->styles)) {
            return $this->defaultStyles;
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

        return array_merge($this->defaultStyles, $stylesArray);
    }

    /**
     * Set the inline styles of the object.
     *
     * @param array $styles
     * @return $this
     */
    public function styles(array $styles): self
    {
        $style = '';
        foreach ($styles as $property => $value) {
            $style .= $property . ': ' . $value . '; ';
        }

        $this->styles = trim($style);
        return $this;
    }

    /**
     * Add a new inline style to the object.
     *
     * @param string $property
     * @param string $value
     * @return $this
     */
    public function addStyle(string $property, string $value): self
    {
        $existingStyles = $this->getStylesArray();
        $existingStyles[$property] = $value;
        
        return $this->styles($existingStyles);
    }

    /**
     * Update an existing inline style of the object.
     *
     * @param string $property
     * @param string $value
     * @return $this
     */
    public function updateStyle(string $property, string $value): self
    {
        $existingStyles = $this->getStylesArray();
        
        if (array_key_exists($property, $existingStyles)) {
            $existingStyles[$property] = $value;
        }
        
        return $this->styles($existingStyles);
    }

    /**
     * Check if the object has a specific inline style.
     *
     * @param string $property
     * @return bool
     */
    public function hasStyle(string $property): bool
    {
        $existingStyles = $this->getStylesArray();
        
        return array_key_exists($property, $existingStyles);
    }

    /**
     * Get the CSS classes of the object.
     *
     * @return string
     */
    public function getClasses(): string
    {
        return $this->classes ?? implode(' ', $this->defaultClasses);
    }

    /**
     * Get the CSS classes as an array.
     *
     * @return array
     */
    public function getClassesArray(): array
    {
        if (empty($this->classes)) {
            return $this->defaultClasses;
        }

        return array_merge($this->defaultClasses, explode(' ', $this->classes));
    }

    /**
     * Set the CSS classes of the object.
     *
     * @param array $classes
     * @return $this
     */
    public function classes(array $classes): self
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

    /**
     * Check if the object has a specific CSS class.
     *
     * @param string $class
     * @return bool
     */
    public function hasClass(string $class): bool
    {
        $existingClasses = $this->getClassesArray();
        
        return in_array($class, $existingClasses);
    }

    /**
     * Add a new CSS class to the object.
     *
     * @param string $class
     * @return $this
     */
    public function addClass(string $class): self
    {
        if (!$this->hasClass($class)) {
            $existingClasses = $this->getClassesArray();
            $existingClasses[] = $class;
            
            return $this->classes($existingClasses);
        }
        
        return $this;
    }

    /**
     * Update an existing CSS class of the object.
     *
     * @param string $oldClass
     * @param string $newClass
     * @return $this
     */
    public function updateClass(string $oldClass, string $newClass): self
    {
        $existingClasses = $this->getClassesArray();
        
        if (($key = array_search($oldClass, $existingClasses)) !== false) {
            $existingClasses[$key] = $newClass;
            
            return $this->classes($existingClasses);
        }
        
        return $this;
    }

    /**
     * Remove a CSS class from the object.
     *
     * @param string $class
     * @return $this
     */
    public function removeClass(string $class): self
    {
        $existingClasses = $this->getClassesArray();
        
        if (($key = array_search($class, $existingClasses)) !== false) {
            unset($existingClasses[$key]);
            
            return $this->classes($existingClasses);
        }
        
        return $this;
    }

    /**
     * Remove an inline style from the object.
     *
     * @param string $property
     * @return $this
     */
    public function removeStyle(string $property): self
    {
        $existingStyles = $this->getStylesArray();
        
        if (array_key_exists($property, $existingStyles)) {
            unset($existingStyles[$property]);
        }
        
        return $this->styles($existingStyles);
    }

    /**
     * Set the default inline styles of the object.
     *
     * @param array $styles
     * @return $this
     */
    public function setDefaultStyles(array $styles): self
    {
        $this->defaultStyles = $styles;
        return $this;
    }

    /**
     * Set the default CSS classes of the object.
     *
     * @param array $classes
     * @return $this
     */
    public function setDefaultClasses(array $classes): self
    {
        $this->defaultClasses = $classes;
        return $this;
    }
}
