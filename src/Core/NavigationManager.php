<?php 

namespace Raakkan\Yali\Core;

use Raakkan\Yali\Core\Pages\PageManager;

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
                'title' => $page['navigationTitle'],
                'slug' => $page['slug'],
                'icon' => $page['navigationIcon'],
                'order' => $page['navigationOrder'],
                'group' => $page['navigationGroup'],
                'pageId' => $pageId
            ];

            $this->addMenuItem($menuItem);
        }
    }

    protected function addMenuItem($menuItem)
    {
        $group = $menuItem['group'] == null ? 'default' : $menuItem['group'];
        $order = $menuItem['order'] ?? 0;
    
        if (!isset($this->menus[$group])) {
            $this->menus[$group] = [];
        }
    
        // Check for duplicate menu item within the same group
        foreach ($this->menus[$group] as $existingMenuItem) {
            if ($existingMenuItem['slug'] === $menuItem['slug']) {
                // Duplicate menu item found
                // You can choose to update the existing menu item or skip adding the duplicate
                // For example, to update the existing menu item:
                // $existingMenuItem['title'] = $menuItem['title'];
                // $existingMenuItem['icon'] = $menuItem['icon'];
                // $existingMenuItem['order'] = $menuItem['order'];
                // $existingMenuItem['pageId'] = $menuItem['pageId'];
                
                // Or, to skip adding the duplicate, simply return
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
