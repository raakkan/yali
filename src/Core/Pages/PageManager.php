<?php 

namespace Raakkan\Yali\Core\Pages;

use Livewire\Livewire;
use Raakkan\Yali\App\PageComponent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Raakkan\Yali\Core\Pages\YaliPage;

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
            foreach (File::allFiles($pagesDirectory) as $file) {
                $class = $pagesNamespace . str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());

                if (class_exists($class) && is_subclass_of($class, YaliPage::class)) {
                    $this->registerPage($class);
                }
            }
        }
    }

    public function loadPluginPages(array $pluginPages)
    {
        foreach ($pluginPages as $pluginPage) {
            if (is_string($pluginPage) && class_exists($pluginPage) && is_subclass_of($pluginPage, YaliPage::class)) {
                $this->registerPage($pluginPage);
            }
        }
    }

    protected function registerPage($class)
    {
        $pageId = $this->generatePageId($class);
        $page = new $class();
        $this->pages[$pageId] = [
            'pageId' => $pageId,
            'class' => $class,
            'title' => $page->getTitle(),
            'navigationTitle' => $page->getNavigationTitle(),
            'navigationGroup' => $page->getNavigationGroup(),
            'navigationIcon' => $page->getNavigationIcon(),
            'navigationOrder' => $page->getNavigationOrder(),
            'slug' => $page->getSlug(),
        ];
    }

    public function registerPages(){
        $pages = $this->getPages();
        foreach ($pages as $pageId => $page) {
            $pageClass = $page['class'];

            Livewire::component('yali::pages.'.$pageId, $pageClass);

            // Register the route for the page with "admin" prefix
            $slug = (new $pageClass)->getSlug();
            Route::prefix('admin')->group(function () use ($slug, $pageId, $pageClass) {
                Route::get($slug, PageComponent::class)->name('yali::pages.'.$pageId);
            });
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
