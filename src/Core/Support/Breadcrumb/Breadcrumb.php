<?php

namespace Raakkan\Yali\Core\Support\Breadcrumb;
use Illuminate\Http\Request;

use Raakkan\Yali\Core\View\YaliComponent;
use Raakkan\Yali\Core\Facades\YaliManager;
use Raakkan\Yali\Core\Support\Concerns\Makable;
use Raakkan\Yali\Core\Support\Navigation\NavigationItem;


class Breadcrumb extends YaliComponent
{
    use Makable;

    public $view = 'yali::components.breadcrumb';

    public $request;

    public $items = [];

    public $navigationManager;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->navigationManager = YaliManager::getNavigationManager();

        $this->getNavigations();
        // dd($this->items);
    }

    public function getNavigations()
    {
        $slugs = explode('/', $this->request->path());

        foreach ($slugs as $index => $slug) {
            $navigation = $this->navigationManager->findBySlug($slug);
                if ($navigation) {
                    $this->items[] = $navigation;
                }
        }
    }

    public function addItem(NavigationItem $item)
    {
        $this->items[] = $item;
    }

    public function getBreadcrumbItems()
    {
        return $this->items;
    }
}