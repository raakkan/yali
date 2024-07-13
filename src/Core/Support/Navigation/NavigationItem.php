<?php 

namespace Raakkan\Yali\Core\Support\Navigation;

use Raakkan\Yali\Core\Support\Concerns\Makable;


class NavigationItem
{
    use Makable;

    public function __construct(
        public $label,
        public $slug,
        public $routeName,
        public $class,
        public $type,
        public $icon = null,
        public $order = 0,
        public $path = null,
        public $childrens = [],
        public $parent = null,
        public $hidden = false,
    ) {}

    public function addChild(NavigationItem $menuItem)
    {
        $this->childrens[] = $menuItem;
        $menuItem->setParent($this);
    }

    public function setParent(NavigationItem $parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function hasParent()
    {
        return $this->parent !== null;
    }

    public function getChildrens()
    {
        return $this->childrens;
    }

    public function hasChildrens()
    {
        return $this->childrens !== null && count($this->childrens) > 0;
    }

    public function getSlug()
    {
        $slug = trim($this->slug, '/');
        return $slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function isActive()
    {
        $currentUrl = request()->url();
        
        $itemUrl = url($this->getPath());

        // if ($this->getLabel() === 'Users') {
        //     dd($itemUrl, $this->getPath());
        // }

        if ($currentUrl === $itemUrl) {
            return true;
        }
        
        if ($this->hasChildrens()) {
            foreach ($this->childrens as $child) {
                if ($child->isActive()) {
                    return true;
                }
                // Check if the child item path matches the current URL pattern
                $childPath = $child->getPath();
                $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $childPath);
                $pattern = str_replace('/', '\/', $pattern);
                
                if (preg_match('/^' . $pattern . '$/', parse_url($currentUrl, PHP_URL_PATH), $matches)) {
                    // Extract the model key from the URL
                    $modelKey = $matches[1] ?? null;

                    // Check if the model key exists in the current URL
                    if ($modelKey && strpos($currentUrl, $modelKey) !== false) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getRouteName()
    {
        return $this->routeName;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPath()
    {
        return $this->path ?? '/admin/' . $this->slug;
    }

    public function isHidden()
    {
        return $this->hidden;
    }
}
