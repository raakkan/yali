<?php

namespace Raakkan\Yali\Core\Support\Concerns\UI;

use Illuminate\Support\Facades\Blade;

trait Iconable
{
    protected $icon;

    protected $iconCssClasses = 'w-6 h-6 mr-3';

    public function icon($icon)
    {
        $this->setIcon($icon);

        return $this;
    }

    public function setIcon($icon)
    {
        if (! is_string($icon) && ! is_callable($icon)) {
            throw new \InvalidArgumentException('Icon must be a string or a callable.');
        }
        $this->icon = $icon;

        return $this;
    }

    public function getIcon()
    {
        return is_callable($this->icon) ? call_user_func($this->icon) : $this->icon;
    }

    public function iconClasses($cssClasses)
    {
        $this->iconCssClasses = $cssClasses;

        return $this;
    }

    public function getIconView()
    {
        $icon = $this->getIcon();
        $cssClasses = $this->iconCssClasses;

        if (is_null($icon)) {
            return null;
        }

        if (view()->exists($icon)) {
            return view($icon)->render();
        } elseif (is_string($icon) && preg_match('/^<svg.*<\/svg>$/s', $icon)) {
            return str_replace('<svg', '<svg class="'.e($cssClasses).'"', $icon);
        } elseif (filter_var($icon, FILTER_VALIDATE_URL)) {
            return sprintf('<img src="%s" alt="Icon" class="%s">', e($icon), e($cssClasses));
        } else {
            return Blade::render(sprintf('<x-yali::icon name="%s" class="%s" />', e($icon), e($cssClasses)));
        }
    }

    public function hasIcon()
    {
        return ! is_null($this->icon);
    }

    public function clearIcon()
    {
        $this->icon = null;

        return $this;
    }
}
