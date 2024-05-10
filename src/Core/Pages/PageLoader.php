<?php 

namespace Raakkan\Yali\Core\Pages;

use Illuminate\Support\Facades\File;
use Raakkan\Yali\Core\Pages\BasePage;

class PageLoader
{
    protected $app;

    protected $pages = [];

    public function __construct($app) {
        $this->app = $app;
    }

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
                    $this->pages[$pageId] = $class;
                }
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
