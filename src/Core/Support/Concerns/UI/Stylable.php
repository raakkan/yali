<?php

namespace Raakkan\Yali\Core\Support\Concerns\UI;

trait Stylable
{
    protected ?string $styles = null;

    protected ?string $classes = null;

    protected array $defaultStyles = [];

    protected array $defaultClasses = [];

    public function getStyles(): string
    {
        return $this->styles ?? implode('; ', array_map(
            fn ($v, $k) => $k.':'.$v,
            $this->defaultStyles,
            array_keys($this->defaultStyles)
        ));
    }

    public function getStylesArray(): array
    {
        if (empty($this->styles)) {
            return $this->defaultStyles;
        }

        $stylesArray = [];
        $styles = explode(';', $this->styles);
        foreach ($styles as $style) {
            $style = trim($style);
            if (! empty($style)) {
                [$property, $value] = explode(':', $style);
                $stylesArray[trim($property)] = trim($value);
            }
        }

        return array_merge($this->defaultStyles, $stylesArray);
    }

    public function styles(array $styles): self
    {
        $style = '';
        foreach ($styles as $property => $value) {
            $style .= $property.': '.$value.'; ';
        }

        $this->styles = trim($style);

        return $this;
    }

    public function addStyle(string $property, string $value): self
    {
        $existingStyles = $this->getStylesArray();
        $existingStyles[$property] = $value;

        return $this->styles($existingStyles);
    }

    public function updateStyle(string $property, string $value): self
    {
        $existingStyles = $this->getStylesArray();

        if (array_key_exists($property, $existingStyles)) {
            $existingStyles[$property] = $value;
        }

        return $this->styles($existingStyles);
    }

    public function hasStyle(string $property): bool
    {
        $existingStyles = $this->getStylesArray();

        return array_key_exists($property, $existingStyles);
    }

    public function getClasses(): string
    {
        return $this->classes ?? implode(' ', $this->defaultClasses);
    }

    public function getClassesArray(): array
    {
        if (empty($this->classes)) {
            return $this->defaultClasses;
        }

        return array_merge($this->defaultClasses, explode(' ', $this->classes));
    }

    public function classes(array $classes): self
    {
        $class = '';
        foreach ($classes as $item) {
            if ($item instanceof \BackedEnum) {
                $class .= $item->value.' ';
            }
            if (is_string($item)) {
                $class .= $item.' ';
            }
        }

        $this->classes = trim($class);

        return $this;
    }

    public function hasClass(string $class): bool
    {
        $existingClasses = $this->getClassesArray();

        return in_array($class, $existingClasses);
    }

    public function addClass(string $class): self
    {
        if (! $this->hasClass($class)) {
            $existingClasses = $this->getClassesArray();
            $existingClasses[] = $class;

            return $this->classes($existingClasses);
        }

        return $this;
    }

    public function updateClass(string $oldClass, string $newClass): self
    {
        $existingClasses = $this->getClassesArray();

        if (($key = array_search($oldClass, $existingClasses)) !== false) {
            $existingClasses[$key] = $newClass;

            return $this->classes($existingClasses);
        }

        return $this;
    }

    public function removeClass(string $class): self
    {
        $existingClasses = $this->getClassesArray();

        if (($key = array_search($class, $existingClasses)) !== false) {
            unset($existingClasses[$key]);

            return $this->classes($existingClasses);
        }

        return $this;
    }

    public function removeStyle(string $property): self
    {
        $existingStyles = $this->getStylesArray();

        if (array_key_exists($property, $existingStyles)) {
            unset($existingStyles[$property]);
        }

        return $this->styles($existingStyles);
    }

    public function setDefaultStyles(array $styles): self
    {
        $this->defaultStyles = $styles;

        return $this;
    }

    public function setDefaultClasses(array $classes): self
    {
        $this->defaultClasses = $classes;

        return $this;
    }
}
