<?php 

namespace Raakkan\Yali\Core\Resources;

class Resource
{
    public $resourceId;
    public $class;
    public $title;
    public $navigationTitle;
    public $navigationGroup;
    public $navigationIcon;
    public $navigationOrder;
    public $slug;

    public function __construct($resourceId, $class, $resource)
    {
        $this->resourceId = $resourceId;
        $this->class = $class;
        $this->title = $resource->getTitle();
        $this->navigationTitle = $resource->getNavigationTitle();
        $this->navigationGroup = $resource->getNavigationGroup();
        $this->navigationIcon = $resource->getNavigationIcon();
        $this->navigationOrder = $resource->getNavigationOrder();
        $this->slug = $resource->getSlug();
    }

    public function getResourceId()
    {
        return $this->resourceId;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getNavigationTitle()
    {
        return $this->navigationTitle;
    }

    public function setNavigationTitle($navigationTitle)
    {
        $this->navigationTitle = $navigationTitle;
    }

    public function getNavigationGroup()
    {
        return $this->navigationGroup;
    }

    public function setNavigationGroup($navigationGroup)
    {
        $this->navigationGroup = $navigationGroup;
    }

    public function getNavigationIcon()
    {
        return $this->navigationIcon;
    }

    public function setNavigationIcon($navigationIcon)
    {
        $this->navigationIcon = $navigationIcon;
    }

    public function getNavigationOrder()
    {
        return $this->navigationOrder;
    }

    public function setNavigationOrder($navigationOrder)
    {
        $this->navigationOrder = $navigationOrder;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
