<?php 

namespace Raakkan\Yali\Core\Support\Navigation;

class NavigationManager
{
    protected $groups = [];

    public function buildNavigation($pages, $resources)
    {
        $this->addGroup('default', '');
        foreach ($pages as $page) {
        }
    }

    public function addGroup($name, $label)
    {
        $this->groups[$name] = new NavigationGroup($name, $label);
    }

    public function getGroup($name)
    {
        return $this->groups[$name] ?? null;
    }

    public function addItemToGroup($groupName, NavigationItem $item)
    {
        if ($group = $this->getGroup($groupName)) {
            $group->addItem($item);
        }
    }

    public function getGroups()
    {
        return $this->groups;
    }
}
