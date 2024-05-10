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
                'url' => $page['routeName'],
                'icon' => $page['navigationIcon'],
                'order' => $page['navigationOrder'],
                'group' => $page['navigationGroup'],
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
