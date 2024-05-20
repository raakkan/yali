<?php

namespace Raakkan\Yali\Core\Pages;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Raakkan\Yali\Core\Exceptions\PageRegistrationException;

class PageManager
{
    protected $pages = [];

    public function loadPages(): void
    {
        $this->loadPagesFromDirectory('Raakkan\\Yali\\App\\Pages\\', __DIR__ . '/../../App/Pages', 'yali');
        $this->loadPagesFromDirectory('App\\Yali\\Pages\\', base_path('app/Yali/Pages'), 'app');
    }

    protected function loadPagesFromDirectory(string $pagesNamespace, string $pagesDirectory, string $source): void
    {
        if (!File::isDirectory($pagesDirectory)) {
            return;
        }

        $files = File::allFiles($pagesDirectory);

        foreach ($files as $file) {
            $class = $pagesNamespace . str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());
            $this->registerPage($class, $source);
        }
    }

    public function loadPluginPages(array $pluginPages): void
    {
        foreach ($pluginPages as $pluginPage) {
            $this->registerPage($pluginPage, 'plugin');
        }
    }

    protected function registerPage(string $class, string $source): void
    {
        if (!class_exists($class)) {
            throw new PageRegistrationException("Page Class {$class} not found");
        }

        if (!is_subclass_of($class, YaliPage::class)) {
            throw new PageRegistrationException("Page Class {$class} is not a subclass of YaliPage");
        }

        $this->pages[$class] = [
            'class' => $class,
            'source' => $source
        ];
    }

    public function registerPages(): void
    {
        foreach ($this->getPages() as $page) {
            $this->registerRoute($page['class']);
        }
    }

    protected function registerRoute(string $page): void
    {
        $slug = $page::getSlug();

        Route::prefix('admin')->group(function () use ($slug, $page) {
            Route::get($slug, $page)->name('yali::pages.' . $page);
        });
    }

    public function getPages(): array
    {
        return $this->pages;
    }
}
