<?php 

namespace Raakkan\Yali\Core\Pages\Manager;

class Page
{
    protected $title;
    protected $slug;
    protected $component;
    protected $layout;
    protected $navigationTitle;
    protected $navigationIcon;
    protected $navigationOrder;

    public function __construct($title, $slug, $component, $layout, $navigationTitle, $navigationIcon, $navigationOrder)
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->component = $component;
        $this->layout = $layout;
        $this->navigationTitle = $navigationTitle;
        $this->navigationIcon = $navigationIcon;
        $this->navigationOrder = $navigationOrder;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getComponent()
    {
        return $this->component;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function getNavigationTitle()
    {
        return $this->navigationTitle;
    }

    public function getNavigationIcon()
    {
        return $this->navigationIcon;
    }

    public function getNavigationOrder()
    {
        return $this->navigationOrder;
    }
}