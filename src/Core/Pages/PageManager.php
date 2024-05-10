<?php 

namespace Raakkan\Yali\Core\Pages;

use Illuminate\Support\Facades\File;
use Raakkan\Yali\Core\Pages\BasePage;

class PageManager
{
    protected $pages = [];

    public function loadAdminPages()
    {
        $pagesNamespace = 'Raakkan\\Yali\\App\\Pages\\';
        $pagesDirectory = __DIR__. '/../../App/Pages';

        $this->loadPagesFromDirectory($pagesNamespace, $pagesDirectory);
    }

    public function loadAppPages()
    {
        $pagesNamespace = 'App\\Yali\\Pages\\';
        $pagesDirectory = base_path('app/Yali/Pages');

        $this->loadPagesFromDirectory($pagesNamespace, $pagesDirectory);
    }

    protected function loadPagesFromDirectory($pagesNamespace, $pagesDirectory)
    {
        if (File::isDirectory($pagesDirectory)) {
            $pageFiles = File::allFiles($pagesDirectory);

            foreach ($pageFiles as $file) {
                $class = $pagesNamespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    $file->getRelativePathname()
                );

                if (class_exists($class) && is_subclass_of($class, BasePage::class)) {
                    $pageId = $this->generatePageId($class);
                    $page = new $class();
                    $this->pages[$pageId] = [
                        'class' => $class,
                        'title' => $page->getTitle(),
                        'navigationTitle' => $page->getNavigationTitle(),
                        'navigationGroup' => $page->getNavigationGroup(),
                        'navigationIcon' => $page->getNavigationIcon(),
                        'navigationOrder' => $page->getNavigationOrder(),
                        'routeName' => $page->getRouteName(),
                    ];
                }
            }
        }
    }

    public function loadPluginPages(array $pluginPages)
    {
        foreach ($pluginPages as $pluginPage) {
            if (class_exists($pluginPage) && is_subclass_of($pluginPage, BasePage::class)) {
                $pageId = $this->generatePageId($pluginPage);
                $page = new $pluginPage();
                $this->pages[$pageId] = [
                    'class' => $pluginPage,
                    'title' => $page->getTitle(),
                    'navigationTitle' => $page->getNavigationTitle(),
                    'navigationGroup' => $page->getNavigationGroup(),
                    'navigationIcon' => $page->getNavigationIcon(),
                    'navigationOrder' => $page->getNavigationOrder(),
                    'routeName' => $page->getRouteName(),
                ];
            }
        }
    }

    protected function generatePageId($class)
    {
        return md5($class);
    }

    /**
     * Get the value of pages
     */ 
    public function getPages()
    {
        return $this->pages;
    }
}
