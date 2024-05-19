<?php 

namespace Raakkan\Yali\Core\Pages\Manager;

class PageFactory
{
    public function create($pageConfig)
    {
        return new Page(
            $pageConfig['title'],
            $pageConfig['slug'],
            $pageConfig['component'],
            $pageConfig['layout'],
            $pageConfig['navigation_title'],
            $pageConfig['navigation_icon'],
            $pageConfig['navigation_order']
        );
    }
}