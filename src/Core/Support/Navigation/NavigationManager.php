<?php 

namespace Raakkan\Yali\Core\Support\Navigation;

use Raakkan\Yali\Core\Pages\PageManager;
use Raakkan\Yali\Core\Resources\ResourceManager;

class NavigationManager
{
    protected $app;
    protected $menus = [];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function loadPageMenus()
    {
        $pageManager = $this->app->make(PageManager::class);

        $pages = $pageManager->getPages();
        
        foreach ($pages as $pageId => $page) {
            $menuItem = [
                'type' => 'page',
                'title' => $page['navigationTitle'],
                'slug' => $page['slug'],
                'icon' => $page['navigationIcon'],
                'order' => $page['navigationOrder'],
                'group' => $page['navigationGroup'],
                'pageId' => $page['pageId'],
            ];

            $this->addMenuItem($menuItem);
        }
    }

    public function loadResourceMenus()
    {
        $resourceManager = $this->app->make(ResourceManager::class);

        $resources = $resourceManager->getResources();
        
        foreach ($resources as $resourceId => $resource) {
            $menuItem = [
                'type' => 'resource',
                'title' => $resource['navigationTitle'],
                'slug' => $resource['slug'],
                'icon' => $resource['navigationIcon'],
                'order' => $resource['navigationOrder'],
                'group' => $resource['navigationGroup'],
                'resourceId' => $resource['resourceId'],
            ];

            $this->addMenuItem($menuItem);
        }
    }

    protected function addMenuItem($menuItem)
    {
        $group = $menuItem['group'] == null ? 'default' : $menuItem['group'];
        $order = $menuItem['order'] == null ? 100 : $menuItem['order'];
    
        if (!isset($this->menus[$group])) {
            $this->menus[$group] = [];
        }
    
         // Check for duplicate menu item within the same group
        foreach ($this->menus[$group] as $existingMenuItem) {
            if (
                (isset($menuItem['pageId']) && isset($existingMenuItem['pageId']) && $menuItem['pageId'] === $existingMenuItem['pageId'])
                || (isset($menuItem['resourceId']) && isset($existingMenuItem['resourceId']) && $menuItem['resourceId'] === $existingMenuItem['resourceId'])
            ) {
                return;
            }
        }
    
        // Find the next available order number
        while (isset($this->menus[$group][$order])) {
            $order++;
        }
    
        $this->menus[$group][$order] = $menuItem;
    }

    public function getMenus()
    {
        foreach ($this->menus as &$group) {
            ksort($group);
        }
        
        return $this->menus;
    }

}
